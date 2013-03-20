var ImportController = function($wizard, $steps_content) {
	var _instance = this;
  // Creating import source
  var importer = new Importer('import');
  // Config
  var animations_speed = 300;
  // Selectors
  var error_container = $('#error_container');
  // Templates
  var day_template     = Template.prepareTemplate($('#template_import_day'));
  var moment_template  = Template.prepareTemplate($('#template_import_moment'));

	$wizard.wizard();

	$steps_content.find('.step2-action').click(function(e) {
		_instance.step2();
	});

	$steps_content.find('.step3-action').click(function(e) {
		_instance.step3();
	});

	$steps_content.find('.step4-action').click(function(e) {
		_instance.step4();
	});

  // Helpers
  var showError = function(message) {
    error_container.text(message);
    error_container.fadeIn(animations_speed);
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

	this.step1 = function() {
		$wizard.wizard('step', 0);
		$('.facebook-action').click(function(e) {
			$(this).off('click').html('<i class="icon-large icon-refresh icon-spin"></i> Login with Facebook');
			API.login(function() {
				_instance.step2();
			});
		});
	};

	this.step2 = function() {
		$wizard.wizard('step', 1);
		var importer = new Importer('instagram');
		if(importer.isConnected())
		{
			$('.instagram-action').html('Instagram connected').attr('disabled', 'disabled');
		}
		else
		{
			$('.instagram-action').click(function(e) {
				(new Importer('instagram')).login(function() {
					_instance.step3();
				});
			});
		};
	};

	this.step3 = function() {
		$wizard.wizard('step', 2);
		var importer = new Importer('flickr');
		if(importer.isConnected())
		{
			$('.flickr-action').html('Flickr connected').attr('disabled', 'disabled');
		}
		else
		{
			$('.flickr-action').click(function(e) {
				(new Importer('flickr')).login(function() {
					_instance.step4();
				});
			});
		};
	};

  // Step 4
  this.step4 = function() {
		$wizard.wizard('step', 3);

    // Days counter
    var total_days_count = 0;

		var step_container = $('#step4');

    // Selectors
    var days_container = step_container.find('.import_days');
    var step4_paginate_button = step_container.find('.paginate');
    var loader_container = step_container.find('#loader_container');
    var progress = loader_container.find('.progress');

    loader_container.fadeIn(animations_speed);

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

			day_container.find('.step3-action').click(function(e) {
				_instance.step3();
			});

			day_container.find('.step5-action').click(function(e) {
				_instance.step5();
			});

      var analyze_button = day_container.find('.analyze-action');

      day_container.find('li').click(function() {
        var thumbnail = $(this).find('.thumbnail');

        thumbnail.toggleClass('ignored');

        if(day_container.find('.thumbnail:not(.ignored)').length === 0) {
          analyze_button.addClass('disabled');
        } else {
          analyze_button.removeClass('disabled');
        }
      });

      analyze_button.click(function() {
        if($(this).hasClass('disabled')) {
          return;
        }

        $(this).addClass('disabled show-spiner');

        _instance.step5(day_container);
      });
    };

    var iterativeFadeIn = function(step_element, step_callback, finish_callback) {
      if(step_element.next().length === 0) {
        if(typeof finish_callback === 'function') {
          finish_callback();
        }
      }

      step_element.animate({opacity:1}, 200, function() {
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
					step4_paginate_button.removeClass('disabled show-spiner').animate({opacity:1}, animations_speed);

          var load_next = function() {
            if(step4_paginate_button.hasClass('disabled')) {
              return;
            }

						step4_paginate_button.addClass('disabled show-spiner');

            next_callback();
          };

          // Events to load next page
					step4_paginate_button.off().click(load_next);
          $(window).off('scrollHitBottom').on('scrollHitBottom', load_next);
        } else {
					step4_paginate_button.animate({opacity:0}, animations_speed);
        }

        total_days_count += days.length;

        if(total_days_count === 0) {
          showError('Sorry. You have no days with 3 or more photos. Try to import photos from another source.');
          return;
        }

        $.each(days, function(index, day) {
          var current_day_container = days_container.append(day_template).children().last();
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
  };

  // Step 5
  this.step5 = function(day_container) {

		$wizard.wizard('step', 4);
    var selected_shots = [];
		if(day_container)
    	day_container.find('li').has('.thumbnail:not(.ignored)').each(function(index, element) {
      	selected_shots.push($(element).data('description'));
    	});

    var analyze_request = API.request('POST', 'days/analyze_external_day', {
      day: selected_shots
    });

    analyze_request.success(function (response) {
			day_container = $('#step5');
      day_container.find('>').slideUp(animations_speed, function() {

        day_container.find('.title').val(response.data.result.title);
				day_container.find('.type').val(response.data.result.type);
				day_container.find('.description').val(response.data.result.description);
        day_container.find('>').slideDown(animations_speed);

        var progress = day_container.find('.progress');

        day_container.find('.export-action').click(function() {
          if($(this).find('.export-action').hasClass('disabled')) {
            return;
          }

          $(this).find('.export-action').addClass('disabled show-spiner');

          var day_data = {
            title: day_container.find('.title').val(),
            type:  day_container.find('.type').val(),
            final_description: day_container.find('.description').val()
          };

          var day_export_request = API.request('POST', 'days/start', day_data);

          day_export_request.success(function(response) {
            var day = response.data.result;
            var requests = [];

            setProgress(progress, 1);

            var finished_count = 0;
            $.each(selected_shots, function(index, shot) {
              var shot_data = {
                time:         Tools.getISODate(new Date(shot.time * 1000)),
                image_url:    shot.image,
                description:  shot.title
              };

              shot_data[importer.getSourceName() + '_id'] = shot.id;

              var moment_create_request = API.request('POST', 'days/' + day.id + '/add_moment', shot_data);

              moment_create_request.success(function (response) {
                finished_count++;

                setProgress(progress, finished_count/selected_shots.length*100);
              });

              requests.push(moment_create_request.send());
            });

            $.when.apply($, requests).then(function() {
              day_container.find('>').slideUp(animations_speed, function() {
                window.location.href = "/pages/" + response.data.result.id + '/day';
              });
            });
          });

          day_export_request.send();

          return false;
        });
      });

    }, true);

    analyze_request.send();
  };
}