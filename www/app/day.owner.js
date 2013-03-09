$(function() {
  // Today date
  var today = Tools.getDate();

  // File reader
  var FileReaderFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

  // Moment time selectors
  var date_input_selector = 'input[subtype=date]';
  var time_input_selector = 'input[subtype=time]';

  // Moment add helpers
  var moments_selector = '.moment-item';
  var moment_placeholder_selector = '.moment-item-placeholder';
  var moment_description_selector = '.moment-description';
  var moment_description_button_selector = 'button[type=submit]';

  // File selector popover
  var popover_template;
  if($.isMobile()) {
    popover_template = $('#template_image_select_mobile').html();
  } else {
    popover_template = $('#template_image_select').html();
  }

  // Import modal
  var modal_container = $('#import_modal');

  // Disable page scroll when modal is visible
  $(modal_container).on('shown', function() {
    $('body').css('overflow', 'hidden');
  });
  $(modal_container).on('hidden', function() {
    $('body').css('overflow', 'auto');
  });

  var popover_file_select_handler = function(event) {
    var $this = $(this);
    var reader = new FileReader();
    var file = event.target.files !== undefined ? event.target.files[0] : (event.target.value ? { name: event.target.value.replace(/^.+\\/, '') } : null);

    $(reader).load(function() {
      var moment = $this.closest(moments_selector);
      moment.find(moment_description_selector).find(moment_description_button_selector).addClass('btn-success').removeClass('disabled');
      moment.addClass('success').removeClass('info');
      moment.find('.moment-image-holder img').attr('src', this.result);
    });

    if (!FileReaderFilter.test(file.type)) {
      alert("Currently we support only images!");
      return;
    }

    reader.readAsDataURL(file);
  };

  var add_image_popover = {
    html: true,
    trigger: 'manual',
    title: 'Select file',
    content: popover_template,
    placement: function() {
      if($(window).width() < 900 || $.isMobile()) {
        return 'bottom';
      } else {
        return 'right';
      }
    }
  };

  var get_moment_date = function(moment) {
    var date_input = moment.find(date_input_selector);
    var time_input = moment.find(time_input_selector);

    return Tools.createDateObject(date_input.val(), time_input.val() + ':' + time_input.attr('seconds'), time_input.attr('timezone'));
  };

  var init_placeholder_actions = function(placeholder) {
    placeholder.bind('dragover', function(event) {
      event.stopPropagation();
      event.preventDefault();
      event.originalEvent.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
      placeholder.addClass('success');
    });

    placeholder.bind('drop', function (event) {
      // event.stopPropagation();
      event.preventDefault();

      // Feature: upload by dragging from another page
      // console.log(event.originalEvent.dataTransfer.getData('text/html'));

      var files = event.originalEvent.dataTransfer.files; // FileList object.

      for (var i = 0, file; file = files[i]; i++) {
        create_moment_from_file(file);
      }
    });

    placeholder.find('a').click(function() {
      var _this = $(this).closest(moment_placeholder_selector);
      var prev_moment = _this.prev();
      var next_moment = _this.next();

      var this_moment = {
        date:Tools.getDate(),
        time:Tools.getTime(),
        time_seconds:Tools.getSeconds(),
        timezone:Tools.getTimezone()
      };

      var new_moment_date;

      if(prev_moment.length !== 0 && next_moment.length !== 0) {
        var prev_timestamp = get_moment_date(prev_moment).getTime();
        var next_timestamp = get_moment_date(next_moment).getTime();

        new_moment_date = new Date();
        new_moment_date.setTime(Math.ceil((prev_timestamp+next_timestamp)/2));

        this_moment = {
          date: Tools.getDate(new_moment_date),
          time: Tools.getTime(new_moment_date),
          time_seconds: Tools.getSeconds(new_moment_date),
          timezone: prev_moment.find(time_input_selector).attr('timezone')
        };
      } else if(next_moment.length !== 0) {
        new_moment_date = get_moment_date(next_moment);

        new_moment_date.setMinutes(new_moment_date.getMinutes() - 15);

        this_moment = {
          date: Tools.getDate(new_moment_date),
          time: Tools.getTime(new_moment_date),
          time_seconds: Tools.getSeconds(new_moment_date),
          timezone: next_moment.find(time_input_selector).attr('timezone')
        };
      }

      _this.find('.with-tooltip').tooltip('hide');
      create_moment(this_moment);
    });
  };

  (function() {
    // Don't open files in browser if user missed moment-box
    $(document).bind('dragover', function(event) {
      event.preventDefault();
      event.originalEvent.dataTransfer.dropEffect = 'none';
      $(moment_placeholder_selector).addClass('info');
    });

    $(document).bind('drop dragleave dragend', function() {
      event.stopPropagation();
      event.preventDefault();
      $(moment_placeholder_selector).removeClass('success info');
    });

    init_placeholder_actions($(moment_placeholder_selector));
  })();

  // Day delete
  var day_delete_button = $('#trigger_day_delete');

  day_delete_button.click(function() {
    if(confirm("Do you really want to delete this day?")) {
      var delete_request = API.request('POST', '/days/' + day_delete_button.attr('day_id') + '/delete');
      delete_request.success(function() {
        window.location = '/pages/my_days';
      });

      delete_request.error(function() {
        alert("We can't delete this day right now, please try again later or tell us about this issue");
      }, true);

      delete_request.send();
    }
  });

  // Day title
  var day_title = $('#day_title_selector');
  var day_title_input = day_title.find('input[type=text]');
  var day_title_button = day_title.find('button[type=submit]');
  var day_title_alert = day_title.find('.alert-small');
  var day_title_alert_contents = day_title_alert.find('.contents');

  day_title_input.on('keyup', function() {
    var text = day_title_input.val();

    if($.trim(text) === '' || text.length < 4) {
      day_title_button.addClass('disabled').removeClass('btn-success');
      day_title_alert.finish().show();
      day_title_alert_contents.text('Title is too short');
    } else if(text.length > 40) {
      day_title_button.addClass('disabled').removeClass('btn-success');
      day_title_alert.finish().show();
      day_title_alert_contents.text('Title is too long');
    } else {
      day_title_button.removeClass('disabled').addClass('btn-success');
      day_title_alert.finish().hide();
    }
  });

  day_title_button.click(function() {
    if(!day_title_button.hasClass('disabled')) {
      day_title_input.prop("disabled", true);
      day_title_button.addClass('disabled');

      var day_title_request = API.request('POST', '/days/'+day_data.id+'/update', {
        title: day_title_input.val()
      });

      day_title_request.success(function() {
        day_title_input.prop("disabled", false);
        day_title_button.text('Save');
        day_title_button.addClass('disabled').removeClass('btn-success');
      });

      day_title_request.error(function() {
        day_title_button.addClass('btn-danger').removeClass('btn-success');
        day_title_button.text('Retry');
      });

      day_title_request.send();
    }
  });

  // Day type
  var day_type = $('#day_type_selector');
  var day_type_buttons = day_type.find('button');

  day_type_buttons.click(function() {
    var $this = $(this);

    day_type_buttons.removeClass('btn-success active');
    $this.addClass('active');

    var day_type_request = API.request('POST', '/days/'+day_data.id+'/update', {
      type: $this.text()
    });

    day_type_request.success(function() {
      $this.addClass('btn-success').removeClass('btn-danger');
    });

    day_type_request.error(function() {
      $this.addClass('btn-danger').removeClass('btn-success');
    });

    day_type_request.send();
  });

  //day opener
  var $open_action = $('#day_open_switch').find('.open-action');
  var $close_action = $('#day_open_switch').find('.close-action');
  $open_action.click(function() {
    $(this).addClass('active').addClass('btn-success');
    $close_action.removeClass('active').removeClass('btn-danger');
    API.post('days/'+day_data.id+'/moments_gathering_enable').send();
  });
  $close_action.click(function() {
    $(this).addClass('active').addClass('btn-danger');
    $open_action.removeClass('active').removeClass('btn-success');
    API.post('days/'+day_data.id+'/moments_gathering_disable').send();
  });

  // Moments
  var moment_template = Template.prepareTemplate($('#template_moment'));

  var insert_moment = function(element) {
    var date_input = element.find(date_input_selector);
    var time_input = element.find(time_input_selector);

    // Returns in UTC Timezone
    var new_datetime = get_moment_date(element);

    var placeholder = element.next();

    var found = false;
    $(moments_selector).each(function() {
      if($(this).is(element) || found) {
        return;
      }

      var tmp_datetime = Tools.createDateObject(
                                $(this).find(date_input_selector).val(),
                                $(this).find(time_input_selector).val() + ':' + $(this).find(time_input_selector).attr('seconds'),
                                $(this).find(time_input_selector).attr('timezone'));

      if(new_datetime < tmp_datetime) {
        found = true;

        element.insertBefore($(this));
      }
    });

    if(!found) {
      $('.moments-list').append(element);
    }

    placeholder.insertAfter(element);
  };

  var attach_moment_events = function(element) {
    var id = element.attr('moment_id');

    var date_input  = element.find(date_input_selector);
    var time_input  = element.find(time_input_selector);

    if($.isMobile()) {
      date_input.attr('type', 'date');
      time_input.attr('type', 'time');
    } else {
      // Moment time
      date_input.datepicker({
        format: 'yyyy-mm-dd',
        startDate: '2000-01-01',
        endDate: today,
        weekStart: 1,
        todayBtn: true,
        todayHighlight: true
      });

      time_input.timepicker({
        minuteStep: 5,
        template: false,
        isOpen: true,
        showMeridian: false
      });
    }

    var datetime_button = element.find('#trigger_save_time');

    time_input.bind('change keyup', function(event) {
      datetime_button.removeClass('disabled').addClass('btn-success');
    });

    date_input.change(function(event) {
      datetime_button.removeClass('disabled').addClass('btn-success');
    });

    datetime_button.click(function() {
      if(!datetime_button.hasClass('disabled')) {
        datetime_button.addClass('disabled');
        time_input.prop('disabled', true);
        date_input.prop('disabled', true);

        var moment_time_request = API.request('POST', '/moments/'+id+'/update', {
          time: date_input.val() + 'T' + time_input.val() + ':' + time_input.attr('seconds') + time_input.attr('timezone')
        });

        moment_time_request.success(function() {
          insert_moment(element, date_input.val(), time_input.val());
          $(window).scrollTo(element, 300);

          time_input.prop('disabled', false);
          date_input.prop('disabled', false);
          datetime_button.addClass('disabled').removeClass('btn-success');
        });

        moment_time_request.error(function() {
          datetime_button.addClass('btn-danger').removeClass('btn-success');
        });

        moment_time_request.send();
      }
    });

    // Moment delete
    var delete_button = element.find('#trigger_moment_delete');

    delete_button.click(function() {
      if(confirm("Do you really want to delete this moment?")) {
        var delete_request = API.request('POST', '/moments/' + id + '/delete');
        delete_request.success(function() {
          remove_moment(element);
        });

        delete_request.error(function() {
          alert("We can't delete moment right now, please try again later or tell us about this issue");
        }, true);

        delete_request.send();
      }
    });

    // Moment description edit
    var description = element.find(moment_description_selector);
    var description_input  = description.find('textarea');
    var description_button = description.find(moment_description_button_selector);

    description_input.on('keyup', function(event) {
      description_button.removeClass('disabled').addClass('btn-success');
    });

    description_button.click(function() {
      if(description_button.hasClass('disabled')) {
        return;
      }

      description_input.prop("disabled", true);
      description_button.addClass('disabled');

      var description_request = API.request('POST', '/moments/' + id + '/update', {
        description: description_input.val()
      });

      description_request.success(function() {
        description_input.prop("disabled", false);
        description_button.addClass('disabled').removeClass('btn-success');
      });

      description_request.error(function() {
        description_button.addClass('btn-danger').removeClass('btn-success');
      });

      description_request.send();

      if(description_button.hasClass('approve-action'))
      {
        API.post('moments/' + id + '/approve')
          .success(function() {
            description.parents('.moment-item').removeClass('moment-item-hidden');
            description_button.removeClass('approve-action');
            description_button.html('Save description');
          })
          .error(function() {
            description_button.addClass('btn-danger').removeClass('btn-success');
          })
          .send();
      }
    });
  };

  var remove_moment = function(element, callback) {
    var fade_time = 500;

    element.next().fadeOut(fade_time, function() {
      element.next().remove();
    });

    element.fadeOut(fade_time, function() {
      element.remove();

      if(callback !== undefined) {
        callback();
      }
    });
  };

  var initialize_import = function(source, element) {
    // Init importer
    var importer = new Importer(source);

    var animations_speed = 300;

    // Templates
    var modal_progress_template          = Template.prepareTemplate($('#template_import_progress'));
    var modal_moments_container_template = Template.prepareTemplate($('#template_import_moments_container'));
    var modal_moment_template            = Template.prepareTemplate($('#template_import_moment'));

    // Selectors
    var modal_body_container = modal_container.find('.modal-body-main');

    modal_body_container.html('');
    modal_body_container.append(Template.compileElement(modal_progress_template));
    modal_body_container.append(Template.compileElement(modal_moments_container_template));

    var modal_import_container = modal_body_container.find('.import-container');
    var modal_thumbnails_container = modal_import_container.find('.thumbnails');
    var modal_thumbnails_paginate_next_button = modal_body_container.find('button.paginate-next');
    var modal_thumbnails_paginate_prev_button = modal_body_container.find('button.paginate-prev');

    var modal_progress = modal_container.find('.import-progress');
    var modal_progress_bar = modal_progress.find('.bar');

    var setProgress = function(percents, callback) {
      modal_progress_bar.css('width', percents + '%');

      if(percents === 100) {
        setTimeout(function() {
          modal_progress.slideUp(animations_speed, callback);
        }, 500);
      } else if(modal_progress.css('display') == 'none') {
        modal_progress.slideDown(animations_speed);
      }
    };

    modal_container.modal('show');

    var attachThumbnailsEvents = function(photos) {
      photos.find('.thumbnail').click(function() {
        var data = $(this).data('description');

        element.find(moment_description_selector).find(moment_description_button_selector).addClass('btn-success').removeClass('disabled');
        element.addClass('success').removeClass('info');

        var img = element.find('.moment-image-holder img');
        img.attr('src', data.image);
        img.attr(source + '_id', data.id);

        element.find('.moment-description textarea').text(data.title);

        modal_container.modal('hide');
      });
    };

    var iterativeFadeIn = function(step_element) {
      step_element.animate({opacity:1}, 200, function() {
        iterativeFadeIn(step_element.next());
      });
    };

    var showNewMoments = function() {
      var new_shots = modal_thumbnails_container.children('.new');
      new_shots.removeClass('new');

      attachThumbnailsEvents(new_shots);

      if(modal_import_container.css('display') === 'none') {
        modal_import_container.slideDown(animations_speed, function() {
          iterativeFadeIn(new_shots.first());
        });
      } else {
        iterativeFadeIn(new_shots.first());
      }
    };

    var onPrevDataRetrieved = function(prev_photos) {
      if(prev_photos.length !== 0) {
        modal_thumbnails_paginate_prev_button.removeClass('disabled show-spiner').slideDown(animations_speed).animate({opacity:1}, animations_speed);

        $.each(prev_photos.reverse(), function(index, photo) {
          var tmp = $($.trim(Template.compileElement(modal_moment_template, photo)));
          tmp.find('.thumbnail').attr('data-description', JSON.stringify(photo));

          modal_thumbnails_container.prepend(tmp);
        });

        showNewMoments();
      } else {
        modal_thumbnails_paginate_prev_button.removeClass('show-spiner').slideUp(animations_speed);
      }
    };

    var onNextDataRetrieved = function(next_photos) {
      if(next_photos.length !== 0) {
        modal_thumbnails_paginate_next_button.removeClass('disabled show-spiner').animate({opacity:1}, animations_speed);

        $.each(next_photos, function(index, photo) {
          var tmp = $($.trim(Template.compileElement(modal_moment_template, photo)));
          tmp.find('.thumbnail').attr('data-description', JSON.stringify(photo));

          modal_thumbnails_container.append(tmp);
        });

        setProgress(100, function() {
          showNewMoments();
        });
      } else {
        modal_thumbnails_paginate_next_button.removeClass('show-spiner').animate({opacity:0}, animations_speed);
      }
    };

    var onDataRetrieved = function(photos, next_callback, prev_callback) {
      if(typeof next_callback === 'function') {
        modal_thumbnails_paginate_next_button.removeClass('disabled show-spiner').animate({opacity:1}, animations_speed);

        modal_thumbnails_paginate_next_button.click(function() {
          if(modal_thumbnails_paginate_next_button.hasClass('disabled')) {
            return;
          }

          modal_thumbnails_paginate_next_button.addClass('disabled show-spiner');

          next_callback().success(function(tmp) {
            console.log(tmp);
          });
        });

        modal_body_container.scroll(function() {
          if(modal_thumbnails_paginate_next_button.hasClass('disabled') || modal_thumbnails_paginate_next_button.css('opacity') == '0') {
            return;
          }

          var _this = $(this);
          var scrollBottom = _this.outerHeight() - _this[0].scrollHeight + _this.scrollTop();

          if(scrollBottom >= -30) {
            modal_thumbnails_paginate_next_button.addClass('disabled show-spiner');
            next_callback();
          }
        });
      } else {
        modal_thumbnails_paginate_next_button.removeClass('show-spiner').animate({opacity:0}, animations_speed);
      }

      if(typeof prev_callback === 'function') {
        modal_thumbnails_paginate_prev_button.removeClass('disabled show-spiner').animate({opacity:1}, animations_speed);

        modal_thumbnails_paginate_prev_button.click(function() {
          if(modal_thumbnails_paginate_prev_button.hasClass('disabled')) {
            return;
          }

          modal_thumbnails_paginate_prev_button.addClass('disabled show-spiner');

          prev_callback();
        });
      } else {
        modal_thumbnails_paginate_prev_button.removeClass('show-spiner').slideUp(animations_speed);
      }

      if(photos.length === 0) {
        modal_thumbnails_paginate_next_button.addClass('disabled').animate({opacity:0}, animations_speed);
        modal_thumbnails_paginate_prev_button.addClass('disabled').animate({opacity:0}, animations_speed).slideUp(animations_speed);

        next_callback(); // Loads all data, sunce it cant find minTimestamp

        return;
      }

      $.each(photos, function(index, photo) {
        var tmp = $($.trim(Template.compileElement(modal_moment_template, photo)));
        tmp.find('.thumbnail').attr('data-description', JSON.stringify(photo));

        modal_thumbnails_container.append(tmp);
      });

      setProgress(100, function() {
        showNewMoments();
      });
    };

    var onTokenRecieved = function() {
      var moments = $(moments_selector);

      var first_moment_date = get_moment_date(moments.first());
      first_moment_date.setDate(first_moment_date.getDate()-3);

      var last_moment_date  = get_moment_date(moments.last());
      last_moment_date.setDate(last_moment_date.getDate()+3);

      var fake_progress = 1;
      var fake_progress_interval = setInterval(function() {
        fake_progress += Math.floor((Math.random()*5)+1);
        if(fake_progress < 80) {
          setProgress(fake_progress);
        } else {
          clearInterval(fake_progress_interval);
        }
      }, 300);

      var request_params = {
        from: Math.floor(last_moment_date.getTime()/1000),
        to:   Math.floor(first_moment_date.getTime()/1000)
      };

      var request_callbacks = {
        onPrevPhotosRecieved: function(all_photos, new_photos) {
          onPrevDataRetrieved(new_photos);
        },
        onNextPhotosRecieved: function(all_photos, new_photos) {
          onNextDataRetrieved(new_photos);
        }
      };

      importer.getUserPhotos(function(photos, next_callback, prev_callback) {
        if(modal_progress.css('display') !== 'none') {
          clearInterval(fake_progress_interval);
          setProgress(90);
        }
        onDataRetrieved(photos, next_callback, prev_callback);
      }, request_params, request_callbacks);
    };

    var onTokenRecieveError = function() {
      modal_container.modal('hide');
      alert("It seems that you declined authorization.");
    };

    if(!importer.isConnected()) {
      importer.login(onTokenRecieved, onTokenRecieveError);
    } else {
      onTokenRecieved();
    }
  };

  var create_moment = function(moment, do_scroll) {
    // Default data
    moment = $.extend({
      date:Tools.getDate(),
      time:Tools.getTime(),
      time_seconds:Tools.getSeconds(),
      timezone:Tools.getTimezone(),
      image:'',
      description:''
    }, moment);

    var tmp = $($.trim(Template.compileElement(moment_template, {moment:moment})));
    var element = tmp.first();

    // Moment description editor
    var description = element.find('.moment-description');
    var description_input = description.find('textarea');

    // Save button
    var save_button = description.find('button[type=submit]');

    if(moment.image === '') {
      var popover = element.find('img').popover(add_image_popover);

      $(popover).bind('shown', function() {
        element.find('input[type=file]').on('change', popover_file_select_handler);

        $('.import-select button').click(function() {
          if($(this).hasClass('disabled')) {
            return;
          }

          initialize_import($(this).attr('data-value'), element);
        });
      });

      save_button.addClass('disabled').removeClass('btn-success');

      element.find('img').load(function() {
        element.find('img').popover('show');
      });
    } else {
      element.addClass('success').removeClass('info');
    }

    // Moment placeholder
    init_placeholder_actions(element.next());

    var date_input  = element.find(date_input_selector);
    var time_input  = element.find(time_input_selector);

    // Moment time
    if($.isMobile()) {
      date_input.attr('type', 'date');
      time_input.attr('type', 'time');
    } else {
      // Moment time
      date_input.datepicker({
        format: 'yyyy-mm-dd',
        startDate: '2000-01-01',
        endDate: today,
        weekStart: 1,
        todayBtn: true,
        todayHighlight: true
      });

      time_input.timepicker({
        minuteStep: 5,
        template: false,
        isOpen: true,
        showMeridian: false
      });
    }

    var datetime_button = element.find('#trigger_save_time');

    time_input.bind('change keyup', function(event) {
      datetime_button.removeClass('disabled').addClass('btn-success');
    });

    date_input.change(function(event) {
      datetime_button.removeClass('disabled').addClass('btn-success');
    });

    datetime_button.click(function() {
      if(!datetime_button.hasClass('disabled')) {
        datetime_button.addClass('disabled');
        time_input.prop('disabled', true);
        date_input.prop('disabled', true);

        insert_moment(element, date_input.val(), time_input.val());
        $(window).scrollTo(element, 300);

        time_input.prop('disabled', false);
        date_input.prop('disabled', false);
        datetime_button.addClass('disabled').removeClass('btn-success');
      }
    });

    // Moment delete
    var delete_button = element.find('#trigger_moment_delete');

    delete_button.click(function() {
      if(confirm("Do you really want to delete this moment?")) {
        element.find('.popover').fadeOut(300, function() {
          element.find('img').popover('hide');
        });
        remove_moment(element);
      }
    });

    // Save moment
    save_button.click(function() {
      if(!save_button.hasClass('disabled')) {
        description_input.prop("disabled", true);
        save_button.addClass('disabled');
        datetime_button.addClass('disabled');
        time_input.prop('disabled', true);
        date_input.prop('disabled', true);

        var moment_image = element.find('.moment-image-holder img');

        var src = moment_image.attr('src');
        var params = {
          description: description_input.val(),
          time: date_input.val() + 'T' + time_input.val() + ':' + time_input.attr('seconds') + time_input.attr('timezone')
        };

        if(src.indexOf('http') === -1) {
          params.image_content = src.substring(src.indexOf('base64')+7);
        } else {
          params.image_url = src;
        }

        $(['instagram', 'flickr', 'facebook']).each(function(index, value) {
          var id = moment_image.attr(value + '_id');
          if(id !== undefined) {
            params[value + '_id'] = id;
          }
        });

        var save_request = API.request('POST', '/days/' + day_data.id + '/add_moment', params);

        moment_image.after($('#template_upload_progress').html());
        var upload_progress_bar = element.find('.moment-upload-progress');
        var upload_progress_bar_indicator = upload_progress_bar.find('.progress .bar');

        upload_progress_bar.css('top', ((moment_image.height()-10)/2) + 'px');

        moment_image.animate({
          opacity: 0.25
        }, 500);

        save_request.params.progress = function(event) {
          if(event.lengthComputable) {
            upload_progress_bar_indicator.css('width', ((event.loaded / event.total) * 100) + '%');
          }
        };

        save_request.success(function(response) {
          element.find('.popover').fadeOut(300, function() {
            element.find('img').popover('hide');
          });
          description_input.prop("disabled", false);
          save_button.addClass('disabled').removeClass('btn-success');
          save_button.text('Save description');
          element.removeClass('moment-item-new info success');
          time_input.prop('disabled', false);
          date_input.prop('disabled', false);
          datetime_button.addClass('disabled').removeClass('btn-success');
          upload_progress_bar.fadeOut(500, function() {
            upload_progress_bar.detach();
          });

          moment_image.animate({
            opacity: 1
          }, 500);

          // Set moment_id
          element.attr('moment_id', response.data.result.id);

          // Re-bind normal events
          element.find('*').off();
          attach_moment_events(element);
        });

        save_request.error(function() {
          save_button.addClass('btn-danger').removeClass('btn-success');
        });

        upload_progress_bar.fadeIn(500, function() {
          save_request.send();
        });
      }
    });

    insert_moment(element);

    if(do_scroll === undefined || do_scroll !== false) {
      $(window).scrollTo(element, 500);
    }

    return element;
  };

  var create_moment_from_file = function(file) {
    var reader = new FileReader();

    var file_date = Tools.getDate(file.lastModifiedDate);
    var file_time = Tools.getTime(file.lastModifiedDate);
    var file_time_seconds = Tools.getSeconds(file.lastModifiedDate);
    var file_timezone_offset = Tools.getTimezone(file.lastModifiedDate);

    $(reader).load(function() {
      var element = create_moment({
        date:file_date,
        time:file_time,
        time_seconds:file_time_seconds,
        timezone:file_timezone_offset,
        image:this.result,
        description:''
      }, false);

      $(window).scrollTo($('.moment-item-new').first(), 500);
    });

    if (!FileReaderFilter.test(file.type)) {
      alert("Currently we support only images!");
      return;
    }

    reader.readAsDataURL(file);
  };

  // Make it accessible globally
  window.create_moment_from_file = create_moment_from_file;
  window.create_moment = create_moment;

  $(moments_selector).each(function() {
    attach_moment_events($(this));
  });

  // Moment description edit
  var final_description = $('.final-description');
  var final_description_input  = final_description.find('textarea');
  var final_description_button = final_description.find('button[type=submit]');

  final_description_input.on('keyup', function(event) {
    final_description_button.removeClass('disabled').addClass('btn-success');
  });

  final_description_button.click(function() {
    if(!final_description_button.hasClass('disabled')) {
      final_description_input.prop("disabled", true);
      final_description_button.addClass('disabled');

      var final_description_request = API.request('POST', '/days/'+day_data.id+'/update', {
        final_description: final_description_input.val()
      });

      final_description_request.success(function() {
        final_description_input.prop("disabled", false);
        final_description_button.addClass('disabled').removeClass('btn-success');
      });

      final_description_request.error(function() {
        final_description_button.addClass('btn-danger').removeClass('btn-success');
      });

      final_description_request.send();
    }
  });
});

