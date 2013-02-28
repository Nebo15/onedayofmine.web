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

      if(prev_moment.length != 0 && next_moment.length != 0) {
        var prev_date_input = prev_moment.find(date_input_selector);
        var prev_time_input = prev_moment.find(time_input_selector);

        var prev_timestamp = Tools.createDateObject(prev_date_input.val(),
                                                  prev_time_input.val() + ':' + prev_time_input.attr('seconds'),
                                                  prev_time_input.attr('timezone')).getTime();

        var next_date_input = next_moment.find(date_input_selector);
        var next_time_input = next_moment.find(time_input_selector);

        var next_timestamp = Tools.createDateObject(next_date_input.val(),
                                                  next_time_input.val() + ':' + next_time_input.attr('seconds'),
                                                  next_time_input.attr('timezone')).getTime();

        var new_moment_date = new Date();
        new_moment_date.setTime(Math.ceil((prev_timestamp+next_timestamp)/2));

        this_moment = {
          date:Tools.getDate(new_moment_date),
          time:Tools.getTime(new_moment_date),
          time_seconds:Tools.getSeconds(new_moment_date),
          timezone:prev_time_input.attr('timezone')
        };
      } else if(next_moment.length != 0) {
        var next_date_input = next_moment.find(date_input_selector);
        var next_time_input = next_moment.find(time_input_selector);

        // Returns in UTC Timezone
        var new_moment_date = Tools.createDateObject(next_date_input.val(),
                                                  next_time_input.val() + ':' + next_time_input.attr('seconds'),
                                                  next_time_input.attr('timezone'));

        new_moment_date.setMinutes(new_moment_date.getMinutes() - 15);

        this_moment = {
          date:Tools.getDate(new_moment_date),
          time:Tools.getTime(new_moment_date),
          time_seconds:Tools.getSeconds(new_moment_date),
          timezone:next_time_input.attr('timezone')
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
    var new_datetime = Tools.createDateObject(date_input.val(), time_input.val() + ':' + time_input.attr('seconds'), time_input.attr('timezone'));

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

  var initialize_instagram_import = function(element) {
    var modal_container      = $('#import_modal');
    var modal_body_container = modal_container.find('.modal-body');
    var modal_save_button    = modal_container.find('.modal-footer button.btn-success');

    var modal_progress_template          = Template.prepareTemplate($('#template_import_progress'));
    var modal_moments_container_template = Template.prepareTemplate($('#template_import_moments_container'));
    var modal_moments_template           = Template.prepareTemplate($('#template_import_moments'));

    modal_body_container.html('');
    modal_body_container.append(Template.compileElement(modal_progress_template));
    modal_body_container.append(Template.compileElement(modal_moments_container_template));

    var modal_thumbnails_container = modal_body_container.find('.thumbnails');

    modal_save_button.click(function() {
      if($(this).hasClass('disabled')) {
        return;
      }

      $(this).addClass('disabled');

      modal_thumbnails_container.find('.thumbnail.selected img').each(function() {
        var $this = $(this);

        var date = new Date();
        date.setTime($this.attr('timestamp')*1000);

        var file_date = Tools.getDate(date);
        var file_description = $this.attr('title');
        var file_time = Tools.getTime(date);
        var file_time_seconds = Tools.getSeconds(date);
        var file_timezone_offset = Tools.getTimezone();

        create_moment({
          date:file_date,
          time:file_time,
          time_seconds:file_time_seconds,
          timezone:file_timezone_offset,
          image:$this.attr('src_big'),
          description:file_description
        }, false);
      });

      remove_moment(element, function() {
        modal_container.modal('hide');
        $(window).scrollTo($('.moment-item-new').first(), 500);
      });
    });

    modal_container.modal('show');

    var attachMomentsEvents = function(moments) {
      moments.find('.thumbnail').click(function() {
        var $this = $(this);
        if($this.hasClass('selected')) {
          $this.removeClass('selected');

          if(moments.find('.thumbnail.selected').length == 0) {
            modal_save_button.addClass('disabled');
          }
        } else {
          $this.addClass('selected');
          modal_save_button.removeClass('disabled');
        }
      });
    };

    var iterativeFadeIn = function(step_element) {
      step_element.fadeIn(100, function() {
        iterativeFadeIn(step_element.next());
      });
    };

    var onDataRetrieved = function(photos) {
      modal_container.find('.bar').css('width', '100%');
      setTimeout(function() {
        modal_body_container.find('.import-progress').slideUp(300, function() {
          $(this).detach();
        });
      }, 500);
    };

    var onDataRetrieveStep = function(step, max_steps, shots) {
      modal_container.find('.bar').css('width', ((step / max_steps) * 100) + '%');

      var tmp = $($.trim(Template.compileElement(modal_moments_template, {moments:shots})));
      modal_thumbnails_container.append(tmp);
      attachMomentsEvents(tmp);
      iterativeFadeIn(tmp.first());
    };

    var onInstagramTokenRecieved = function() {
      Instagram.getCurrentUserPhotos(onDataRetrieved, onDataRetrieveStep);
    };

    var onInstagramTokenRecieveError = function() {
      modal_container.modal('hide');
      alert("It seems that you declined Instagram authorization.");
    };

    Instagram.getAccessToken(onInstagramTokenRecieved, onInstagramTokenRecieveError);
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

          switch($(this).attr('data-value')) {
            case 'instagram':
              initialize_instagram_import(element);
              break;
            case 'flickr':
              initialize_flickr_import(element);
              break;
          }
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

        var src = element.find('img').attr('src');
        var params = {
          description: description_input.val(),
          time: date_input.val() + 'T' + time_input.val() + ':' + time_input.attr('seconds') + time_input.attr('timezone')
        };

        if(src.indexOf('http') === -1) {
          params.image_content = src.substring(src.indexOf('base64')+7);
        } else {
          params.image_url = src;
        }

        var save_request = API.request('POST', '/days/' + day_data.id + '/add_moment', params);

        var moment_image = element.find('.moment-image-holder img');

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
