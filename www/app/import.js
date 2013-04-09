var ImportController = function($wizard, $steps_content) {
	var _instance = this;
  // Creating import source
  var importer = new Importer('import');
  var importer_instagram = new Importer('instagram');
  var importer_flickr = new Importer('flickr');
  var importer_facebook = new Importer('facebook');

  // Config
  var animations_speed = 300;
  // Selectors
  var error_container = $('#error_container');
  // Templates
  var day_template     = Template.prepareTemplate($('#template_import_day'));
  var moment_template  = Template.prepareTemplate($('#template_import_moment'));

  // Init wizard
	$wizard.wizard();

  // Helpers
  var showError = function(message) {
    error_container.text(message);
    error_container.slideDown(animations_speed);
  };

  var hideError = function() {
    error_container.text('');
    error_container.slideUp(animations_speed);
  };

  var setProgress = function(progress, percents) {
    var progress_bar = progress.find('.bar');
    progress_bar.css('width', percents + '%');

    if(percents === 100) {
      progress.slideUp(animations_speed);
    } else if(progress.css('display') == 'none') {
      progress.slideDown(animations_speed);
    }
  };

  var bindStepChangeButtons = function(selector) {
    $(selector).find('.action-step-change').click(function() {
      var next_step_index = $(this).data('target').substring(5);
      if(next_step_index != $wizard.wizard('selectedItem').step) {
        _instance.setStep(next_step_index);
      }
    });
  };

  this.setStep = function(step) {
    console.log('Changing step to: ' + step);
    hideError();
    $wizard.wizard('step', step - 1);
  };

  var selected_day_container;

  var steps = {
    1: function() {
      $('.facebook-action').click(function() {
        var $this = $(this);
        $this.showSpinner();
        API.login(function() {
          $this.hideSpinner();
          $wizard.wizard('step', 1);
        }, function() {
          $this.hideSpinner();
        });
      });
    },

    2: function() {
      $('.create-action').off().click(function() {
        API.post('days/start', {title:'My day', type:'Working day'}).success(function(resp) {
          window.location.href= '/pages/'+resp.data.result.id+'/day';
        }).send();
      });

      $('.action-connect-instagram').click(function() {
        var $this = $(this);

        if($this.hasClass('disabled')) {
          return;
        }

        $this.addClass('disabled');
        $this.closest('.with-spinner').showSpinner();

        importer_instagram.login(function() {
          $this.closest('.with-spinner').hideSpinner();
          $this.text('Instagram connected');

          if($('.action-connect-flickr').hasClass('disabled')) {
            _instance.setStep(3);
          }
        }, function() {
          $this.closest('.with-spinner').hideSpinner();
          $this.removeClass('disabled');
          showError("It seems that you have canceled autorization");
        });
      });

      $('.action-connect-flickr').click(function() {
        var $this = $(this);

        if($this.hasClass('disabled')) {
          return;
        }

        $this.addClass('disabled');
        $this.closest('.with-spinner').showSpinner();

        importer_flickr.login(function() {
          $this.closest('.with-spinner').hideSpinner();
          $this.text('Flickr connected');

          if($('.action-connect-instagram').hasClass('disabled')) {
            _instance.setStep(3);
          }
        }, function() {
          $this.closest('.with-spinner').hideSpinner();
          $this.removeClass('disabled');
          showError("It seems that you have canceled autorization");
        });
      });

      if(importer_instagram.isConnected()) {
        $('.action-connect-instagram').addClass('disabled').text('Instagram connected');
      }

      if(importer_flickr.isConnected()) {
        $('.action-connect-flickr').addClass('disabled').text('Flickr connected');
      }
    },

    3: function() {
      // Days counter
      var total_days_count = 0;

      var step_container = $('#step3');

      // Selectors
      var days_container = step_container.find('.import_days');
      var days_paginate_button = step_container.find('.paginate');
      var loader_container = step_container.find('#loader_container');
      var progress = loader_container.find('.progress');

      days_container = days_container.html('');
      days_paginate_button.css('opacity', '0');

      var fake_progress = 1;
      var fake_progress_interval = setInterval(function() {
        fake_progress += 6;
        if(fake_progress < 90) {
          setProgress(progress, fake_progress);
        } else {
          clearInterval(fake_progress_interval);
        }
      }, 300);

      // Helpers
      var attachThumbnailsEvents = function(day_container) {
        bindStepChangeButtons(day_container);

        var analyze_button = day_container.find('.action-descibe');

        day_container.find('li').click(function() {
          var thumbnail = $(this);

          thumbnail.toggleClass('ignored');

          if(day_container.find('li:not(.ignored)').length === 0) {
            analyze_button.addClass('disabled');
          } else {
            analyze_button.removeClass('disabled');
          }
        });

        analyze_button.click(function() {
          if(analyze_button.hasClass('disabled')) {
            return;
          }

          analyze_button.addClass('disabled').showSpinner();

          selected_day_container = day_container;
          _instance.setStep(4);
        });
      };

      var iterativeFadeIn = function(step_element, step_callback, finish_callback) {
        if(step_element.next().length === 0) {
          if(typeof finish_callback === 'function') {
            finish_callback();
          }
        }

        step_element.animate({opacity:1}, 200, function() {
          step_element.addClass('visible').css('opacity', '');
          if(typeof step_callback === 'function') {
            step_callback(step_element);
          }

          iterativeFadeIn(step_element.next(), step_callback, finish_callback);
        });
      };

      var handleProgressBar = function(callback) {
        if(loader_container.css('display') !== 'none') {
          clearInterval(fake_progress_interval);
          setProgress(progress, 101);
          setTimeout(function() {
            loader_container.slideUp(animations_speed, function() {
              callback();
            });
          }, 1000);
        } else {
          callback();
        }
      };

      var onDataRetrieved = function(days, next_callback) {
        handleProgressBar(function() {
          if(next_callback && days.length > 0) {
            days_paginate_button.removeClass('disabled').animate({opacity:1}, animations_speed);
            days_paginate_button.hideSpinner();

            var load_next = function() {
              if(days_paginate_button.hasClass('disabled'))
                return;
              days_paginate_button.addClass('disabled');
              days_paginate_button.showSpinner();
              next_callback();
            };

            // Events to load next page
            days_paginate_button.off().click(load_next);
            $(window).off('scrollHitBottom').on('scrollHitBottom', load_next);
          } else {
            days_paginate_button.animate({opacity:0}, animations_speed);
          }

          total_days_count += days.length;

          if(total_days_count === 0) {
            showError('Sorry. It seems that you have never published more than 2 photos of same day.');
            return;
          }

          $.each(days, function(index, day) {
            var current_day_container = days_container.append(day_template).children().last();

            current_day_container.find('h4').html(Tools.getDate(new Date(day[0].time * 1000)));
            var current_day_moments_container = current_day_container.find('.thumbnails');

            $.each(day, function(photo_index, photo) {
              var tmp = $($.trim(Template.compileElement(moment_template, photo)));
              tmp.attr('data-description', JSON.stringify(photo));
              current_day_moments_container.append(tmp);
            });

            attachThumbnailsEvents(current_day_container);
          });

          iterativeFadeIn(days_container.children().first(), function(step_element) {
            iterativeFadeIn(step_element.children().first().children().first());
          });
        });
      };

      // Start retrieving days
      importer.getUserDays(onDataRetrieved);
    },

    4: function() {
      var step_container = $('#step4');
      var loader_container = step_container.find('#loader_container');
      var progress = loader_container.find('.progress');

      var selected_shots = [];
      if(selected_day_container === undefined) {
        showError('Day is not selected');
        return;
      } else {
        selected_day_container.find('li').not('.ignored').each(function(index, element) {
          selected_shots.push($(element).data('description'));
        });
      }

      loader_container.css('display', 'none').slideDown(animations_speed);

      var fake_progress = 1;
      var fake_progress_interval = setInterval(function() {
        fake_progress += 6;
        if(fake_progress < 90) {
          setProgress(progress, fake_progress);
        } else {
          clearInterval(fake_progress_interval);
        }
      }, 300);

      var analyze_request = API.request('POST', 'days/analyze_external_day', {
        day: selected_shots
      });

      analyze_request.success(function(response) {
        clearInterval(fake_progress_interval);
        setProgress(progress, 101);
        setTimeout(function() {
          loader_container.slideUp(animations_speed);
        }, 300);

        var analyzed_description = response.data.result;

        var submit_button = step_container.find('button[type=submit]');
        var day_title_input = step_container.find('.day-title-selector input');
        var day_type_buttongroup = step_container.find('.day-type-selector button');
        var day_description_textarea = step_container.find('.day-description-selector textarea');

        day_title_input.val(analyzed_description.title);
        day_type_buttongroup.removeClass('active').filter(':contains('+analyzed_description.type+')').addClass('active');
        day_description_textarea.val(analyzed_description.description);

        // Show form
        step_container.find('form').slideDown(animations_speed);

        step_container.find('form').off('submit').submit(function() {
          if(submit_button.hasClass('disabled')) {
            return;
          }

          var day_data = {
            title: $.trim(day_title_input.val()),
            type:  day_type_buttongroup.filter('.active').text(),
            final_description: $.trim(day_description_textarea.val())
          };

          // Validate inputs
          var invalid = false;
          if(!day_data.title || day_data.title.length < 3) {
            step_container.find('.day-title-selector').addClass('error');
            invalid = true;
          } else {
            step_container.find('.day-title-selector').removeClass('error');
          }

          if(selected_shots.length < 1) {
            alert("There are no selected moments given");
            invalid = true;
          }

          // Final description is not required
          // if(day_data.final_description && day_data.final_description.length < 3) {
          //   step_container.find('.day-description-selector').addClass('error');
          //   invalid = true;
          // } else {
          //   step_container.find('.day-description-selector').removeClass('error');
          // }

          if(!day_data.type) {
            alert("Day type is not set");
            invalid = true;
          }

          if(invalid) {
            return false;
          }

          submit_button.addClass('disabled').showSpinner();
          loader_container.css('display', 'none').slideDown(animations_speed);
          setProgress(progress, 1);

          var day_export_request = API.request('POST', 'days/start', day_data);

          day_export_request.success(function(day_create_response) {
            var day = day_create_response.data.result;
            var step_percentage = 100/selected_shots.length+1;
            setProgress(progress, step_percentage);

            var requests = [];
            var finished_count = 1;

            $.each(selected_shots, function(index, shot) {
              var shot_data = {
                time:         Tools.getISODate(new Date(shot.time * 1000)),
                image_url:    shot.image,
                description:  shot.title
              };

              shot_data[shot.service + '_id'] = shot.id;

              var moment_create_request = API.request('POST', 'days/' + day.id + '/add_moment', shot_data);

              moment_create_request.success(function (response) {
                finished_count++;
                setProgress(progress, finished_count*step_percentage+1);
              });

              requests.push(moment_create_request.send());
            });

            $.when.apply($, requests).then(function() {
              loader_container.slideUp(animations_speed, function() {
                window.location.href = "/pages/" + day.id + '/day';
              });
            });
          });

          day_export_request.send();

          return false;
        });
      }, true);

      analyze_request.send();
    }
  };

  // Bind wizard events
  $wizard.on('changed', function() {
    steps[$wizard.wizard('selectedItem').step]();
  });

  bindStepChangeButtons('body');
};
