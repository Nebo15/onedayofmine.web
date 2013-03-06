$(function() {
  "use strict";

  // Config
  var animations_speed = 500;

  // Selectors
  var error_container = $('#error_container');
  var step_container  = $('#step_container');

  var progress        = $('.progress');
  var progress_bar    = progress.find('.bar');

  // Templates
  var day_template     = Template.prepareTemplate($('#template_import_day'));
  var moment_template  = Template.prepareTemplate($('#template_import_moment'));
  var step1_template   = Template.prepareTemplate($('#template_step1'));
  var step2_template   = Template.prepareTemplate($('#template_step2'));
  var step3_template   = Template.prepareTemplate($('#template_step3'));
  var step4_template   = Template.prepareTemplate($('#template_step4'));

  // Helpers
  var setProgress = function(percents) {
    progress_bar.css('width', percents + '%');

    if(percents === 100) {
      progress.fadeOut(animations_speed);
    } else if(progress.css('display') == 'none') {
      progress.fadeIn(animations_speed);
    }
  };

  var showError = function(message) {
    error_container.text(message);
    error_container.fadeIn(animations_speed);
  };

  // Step 1
  var step1 = function() {
    step_container.html(step1_template);

    if(!Instagram.isConnected()) {
      step_container.find('.btn').click(function() {
        Instagram.getAccessToken(function() {
          step2();
        });
      });
    } else {
      step2();
    }
  };

  // Step 2
  var step2 = function(animate) {
    // Prepare container
    step_container.html(step2_template);

    // Selectors
    var days_container = step_container.find('.import_days');
    var step2_paginate_button = step_container.find('.paginate');

    // Helpers
    var attachThumbnailsEvents = function(day_container) {
      var analyze_button = day_container.find('.analyze-action');

      day_container.find('li').click(function() {
        var thumbnail = $(this).find('.thumbnail');

        if(thumbnail.hasClass('selected')) {
          thumbnail.removeClass('selected');

          if(day_container.find('.thumbnail.selected').length == 0) {
            analyze_button.addClass('disabled');
          }
        } else {
          thumbnail.addClass('selected');
          analyze_button.removeClass('disabled');
        }
      });

      analyze_button.click(function() {
        if($(this).hasClass('disabled')) {
          return;
        }

        step3(day_container);
      });
    };

    var iterativeFadeIn = function(step_element) {
      step_element.fadeIn(100, function() {
        iterativeFadeIn(step_element.next());
      });
    };

    var onDataRetrieved = function(days, next_callback) {
      if(next_callback && days.length > 0) {
        step2_paginate_button.removeClass('disabled').fadeIn(animations_speed);

        step2_paginate_button.click(function() {
          if($(this).hasClass('disabled')) {
            return;
          }

          $(this).addClass('disabled');

          next_callback();
        });
      } else {
        step2_paginate_button.fadeOut(animations_speed);
      }

      setProgress(5 + (days.length / 5) * 95); // TODO real progress bar

      $.each(days, function(index, day) {
        var current_day_container = days_container.append(day_template).children().last();
        var current_day_moments_container = current_day_container.find('.thumbnails');

        $.each(day, function(photo_index, photo) {
          var tmp = $($.trim(Template.compileElement(moment_template, photo)));

          tmp.attr('data-description', JSON.stringify(photo));

          current_day_moments_container.append(tmp);
          iterativeFadeIn(tmp.first());
        });

        attachThumbnailsEvents(current_day_container);
      });
    };

    // Add progress
    setProgress(5);

    // Start retrieving days
    Instagram.getUserDays(onDataRetrieved);
  };

  // Step 3
  var step3 = function(day_container) {
    var selected_shots = [];
    day_container.find('li').has('.thumbnail.selected').each(function(index, element) {
      selected_shots.push($(element).data('description'));
    });

    var analyze_request = API.request('POST', 'days/analyze_external_day', {
      day: selected_shots
    });

    analyze_request.success(function (response) {
      day_container.find('>').slideUp(300, function() {
        day_container.html(Template.compileElement(step3_template, response.data.result));

        day_container.find('>').slideDown(300);

        day_container.find('form').submit(function() {
          if($(this).hasClass('disabled')) {
            return;
          }

          $(this).addClass('disabled');

          var day_data = {
            title: day_container.find('.title').val(),
            type:  day_container.find('.type').val(),
            final_description: day_container.find('.description').val()
          };

          var day_export_request = API.request('POST', 'days/start', day_data);

          day_export_request.success(function(response) {
            var day = response.data.result;
            var requests = [];

            var finished_count = 0;
            $.each(selected_shots, function(index, shot) {
              var shot_data = {
                time:         Tools.getISODate(new Date(shot.time * 1000)),
                image_url:    shot.image,
                description:  shot.title,
                instagram_id: shot.id
              };

              var moment_create_request = API.request('POST', 'days/' + day.id + '/add_moment', shot_data);

              moment_create_request.success(function (response) {
                finished_count++;
              });

              requests.push(moment_create_request.send());
            });

            $.when.apply($, requests).then(function() {
              day_container.html(Template.compileElement(step4_template, day));
            });
          });

          day_export_request.send();

          return false;
        });
      });

    }, true);

    analyze_request.send();
  };

  // Running inital step
  step1();
});
