$(function() {
  "use strict";

  // Tools to work with images
  var FileReaderFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

  var ImageTools = {
    Convert: {
      imageToDataURL: function(path) {
        var def = $.Deferred();

        if(!path || path.indexOf('base64') != -1) {
          def.resolve(path);
        } else {
          if(path.indexOf(window.location.hostname) == -1) {
            path = proxy_path + path;
          }

          ImageTools.Convert.dataURLToCanvas(path).done(function(canvas) {
            def.resolve(canvas.toDataURL("image/jpeg"));
          }).fail(function() {
            def.reject();
            console.error("Can't get data_url from path: ", path);
          });
        }

        return def.promise();
      },

      dataURLToBase64: function(data_url) {
        var def = $.Deferred();
        def.resolve(data_url.substring(data_url.indexOf('base64,') + 7));
        return def.promise();
      },

      dataURLToCanvas: function(data_url) {
        var def = $.Deferred();
        var image = new Image();
        var canvas = document.createElement("canvas");

        image.onerror = function() {
          console.error("Can't create canvas from image");
          def.reject();
        };

        image.onload = function() {
          canvas.width = image.width;
          canvas.height = image.height;

          var ctx = canvas.getContext("2d");
          ctx.drawImage(image, 0, 0);

          def.resolve(canvas, ctx, image);
        };

        image.src = data_url;

        return def.promise();
      },

      fileToDataURL: function(file) {
        var def = $.Deferred();

        var reader = new FileReader();

        reader.onload = function() {
          var data_url = this.result;
          if(!data_url) {
            alert("Can't read file contents");
            def.reject();
            return;
          }

          def.resolve(data_url);
        };

        if (!FileReaderFilter.test(file.type)) {
          alert("Sorry, but we support only images");
          def.reject();
        } else {
          reader.readAsDataURL(file);
        }

        return def.promise();
      },

      dataURLToExif: function(data_url) {
        var def = $.Deferred();
        ImageTools.Convert.dataURLToBase64(data_url).done(function(base64) {
          def.resolve($.createBinaryFile().fromBase64(base64).getExif());
        });
        return def.promise();
      }
    },

    Transform: {
      rotate: function(data_url, oritentation) { // 2-side rotation
        var def = $.Deferred();
        var image = new Image();
        var canvas = document.createElement("canvas");

        image.onerror = function() {
          console.error("Can't rotate image");
          def.reject();
        };

        image.onload = function() {
          var img_dim = {
            width: image.width,
            height: image.height
          };

          canvas.width = img_dim.height;
          canvas.height = img_dim.width;

          var angle_mul = oritentation == 'left' ? -1 : 1;

          var ctx = canvas.getContext("2d");
          ctx.translate(canvas.width/2, canvas.height/2);
          ctx.rotate(angle_mul * Math.PI / 2);
          ctx.drawImage(image, -(image.width/2), -(image.height/2));

          def.resolve(canvas.toDataURL("image/jpeg"));
        };

        image.src = data_url;

        return def.promise();
      },

      crop: function(data_url, params) {
        var def = $.Deferred();
        var image = new Image();
        var canvas = document.createElement("canvas");

        image.onerror = function() {
          console.error("Can't rotate image");
          def.reject();
        };

        image.onload = function() {
          var size_x_ratio = image.width / params.scaledImageWidth;
          var size_y_ratio = image.height / params.scaledImageHeight;

          canvas.width = params.cropWidth*size_x_ratio;
          canvas.height = params.cropWidth*size_x_ratio;

          var ctx = canvas.getContext("2d");

          ctx.drawImage(image, params.x*size_x_ratio,
                               params.y*size_y_ratio,
                               params.cropWidth*size_x_ratio,
                               params.cropHeight*size_y_ratio,
                               0,
                               0,
                               params.cropWidth*size_x_ratio,
                               params.cropWidth*size_x_ratio);

          def.resolve(canvas.toDataURL("image/jpeg"));
        };

        image.src = data_url;

        return def.promise();
      }
    }
  };

  // Main container selector
  var $day = $('.day');

  // Selector string that is used globally
  var day_final_description_form_selector = 'form[name=final_description_form]';
  var day_final_description_form_input_selector = 'textarea[name=text]';
  var day_final_description_form_submit_btn_selector = '.btn[type=submit]';

  // Day info editing
  (function() {
    // Controls containers
    var $controls = $day.find('header .day-controls-group');
    var $toolbar = $day.find('.day-toolbar');

    // Day title
    var $title_form = $controls.find('form[name=day_title_from]');
    var $title_form_input = $title_form.find('input[name=title]');
    var $title_form_submit_btn = $title_form.find('button[type=submit]');

    $title_form_input.attachValidator({
      button: $title_form_submit_btn,
      saveValidationState: true,
      minLength: 3,
      maxLength: 100,
      messages: {
        empty: "Day title should not be empty",
        minLength: "Day title should be longer than 3 characters",
        maxLength: "Day title should not be longer than 100 characters"
      },
      onError: function() {
        $title_form_submit_btn.removeClass('btn-success');
      },
      onSuccess: function() {
        $title_form_submit_btn.addClass('btn-success');
      }
    });

    $title_form.submit(function(event) {
      if($title_form_submit_btn.hasClass('disabled')) {
        return false;
      }

      $title_form_input.prop("disabled", true);
      $title_form_submit_btn.addClass('disabled');
      $title_form_submit_btn.showSpinner();

      var day_title_request = API.request('POST', '/days/' + day_data.id + '/update', {
        title: $title_form_input.val()
      });

      day_title_request.success(function() {
        $title_form_submit_btn.hideSpinner();
        $title_form_input.prop("disabled", false);
        $('meta[property="og:title"]').prop('content',  $title_form_input.val());
        $title_form_submit_btn.addClass('disabled').removeClass('btn-success btn-danger');
      });

      day_title_request.error(function() {
        $title_form_submit_btn.hideSpinner();
        $title_form_input.prop("disabled", false);
        $title_form_submit_btn.addClass('btn-danger').removeClass('btn-success disabled');
      });

      day_title_request.send();

      return false;
    });

    // Day type
    var $type_form = $controls.find('form[name=day_type_from]');
    var $type_form_btns = $type_form.find('.btn');

    var $type_form_default_btn = $type_form_btns.filter('.active');
    // var type_request_timeout;

    $type_form.submit(function() {
      var $active_btn = $type_form_btns.filter('.active');

      if($type_form_default_btn.is($active_btn)) {
        return false;
      }

      if($active_btn.length !== 1) {
        console.error("Can't find day type active button");
      }

      var type_request = API.request('POST', '/days/' + day_data.id + '/update', {
        type: $active_btn.text()
      });

      type_request.success(function() {
        $active_btn.removeClass('btn-danger');
        $type_form_default_btn = $active_btn;
      });

      type_request.error(function() {
        $active_btn.addClass('btn-danger').removeClass('btn-success');
      });

      // clearTimeout(type_request_timeout);
      // type_request_timeout = setTimeout(function() {
      type_request.send();
      // }, 500);

      return false;
    });

    // Day delete
    var $delete_btn = $toolbar.find('.action-delete');

    $delete_btn.click(function() {
      if(confirm("Do you really want to delete this day?")) {
        var delete_request = API.request('POST', '/days/' + day_data.id + '/delete');

        delete_request.success(function() {
          window.location = '/pages/my_days';
        });

        delete_request.error(function() {
          alert("We can't delete this day right now, please try again later or tell us about this issue");
        }, true);

        delete_request.send();
      }
    });

    // Day final description edit
    var $final_description_form = $day.find(day_final_description_form_selector);
    var $final_description_form_input = $final_description_form.find(day_final_description_form_input_selector);
    var $final_description_form_submit_btn = $final_description_form.find(day_final_description_form_submit_btn_selector);

    $final_description_form_input.on('keyup', function() {
      $final_description_form_submit_btn.removeClass('disabled').addClass('btn-success');
    });

    $final_description_form.submit(function() {
      if($final_description_form_submit_btn.hasClass('disabled')) {
        return false;
      }

      $final_description_form_input.prop("disabled", true);
      $final_description_form_submit_btn.addClass('disabled');

      var final_description_request = API.request('POST', '/days/' + day_data.id + '/update', {
        final_description: $final_description_form_input.val()
      });

      final_description_request.success(function() {
        $final_description_form_input.prop("disabled", false);
        $final_description_form_submit_btn.addClass('disabled').removeClass('btn-success');

        // Promt user to share day (1 time for each day)
        var share_helper_key = 'days/' + day_data.id + '/share_promted';
        if(!Storage.get(share_helper_key)) {
          Storage.set(share_helper_key, true);
          var $share_btn = $('.action-share');
          if($share_btn.length > 0) {
            $share_btn[0].click();
          }
        }
      });

      final_description_request.error(function() {
        $final_description_form_input.prop("disabled", false);
        $final_description_form_submit_btn.addClass('btn-danger').removeClass('btn-success');
      });

      final_description_request.send();

      return false;
    });
  })();

  // Moments editing
  (function() {
    var $moments = $day.find('.moments');

    // Selector strings
    var moment_selector = 'article';
    var placeholder_class = 'placeholder';
    var placeholder_selector = '.' + placeholder_class;
    var moment_template_class = 'template';
    var moment_without_image_class = 'noimage';

    var delete_btn_selector = '.action-delete';
    var image_container_selector = ".image";
    var image_selector = ".thumbnail img";

    var datetime_form_selector = 'form[name=datetime_form]';
    var datetime_form_date_input_selector = 'input[name=date]';
    var datetime_form_time_input_selector = 'input[name=time]';
    var datetime_form_seconds_input_selector = 'input[name=seconds]';
    var datetime_form_timezone_selector = 'input[name=timezone]';
    var datetime_form_submit_btn_selector = '.btn[type=submit]';

    var description_form_selector = 'form[name=moment_description_form]';
    var description_form_input_selector = 'textarea[name=text]';
    var description_form_submit_btn_selector = '.btn[type=submit]';

    var image_select_popover_selector = '.popover';
    var image_select_popover_btns_selector = '.file-selector .btn';
    var image_select_popover_file_input_selector = 'input[type=file]';

    var image_upload_progress_selector = '.image-upload-progress';
    var image_upload_progress_bar_selector = '.progress .bar';

    var image_toolbar_selector = '.image-toolbar';
    var image_has_changes_class = 'edited';
    var image_has_crop_tool_class = 'has-crop-tool';
    var image_toolbar_expanded_class = 'expanded';
    var image_action_edit_confirm_btn_selector = '.action-edit-confirm';

    var image_action_use_as_cover_btn_selector = '.action-use-as-cover';
    var image_action_rotate_left_btn_selector = '.action-rotate-left';
    var image_action_rotate_right_btn_selector = '.action-rotate-right';
    var image_action_crop_btn_selector = '.action-crop';

    var jcrop_holder_selector = '.jcrop-holder';

    // Params
    var proxy_path = '/proxy?source=';
    var animations_speed = 300;
    var scroll_speed = 800;
    var image_width = 532;
    var image_height = 532;

    // Templates
    var moment_template = Template.prepareTemplate($('#template_moment'));

    // Pure HTML templates
    var image_select_popover_template = $('#template_image_select_popover').html();
    var image_select_popover_mobile_template = $('#template_image_select_popover_mobile').html();
    var image_upload_progress_template = $('#template_image_upload_progress').html();

    // Init
    attachDatetimePickers();

    // Lookup methods
    function getMomentByContext(context) {
      return $(context).closest('article');
    }

    function findNextMoment(moment) {
      return $(moment).nextAll(moment_selector).first();
    }

    function findPrevMoment(moment) {
      return $(moment).prevAll(moment_selector).first();
    }

    function findNextNewMoment(moment) {
      return $(moment).nextAll(moment_selector + '.' + moment_template_class).first();
    }

    function findFirstNewMoment() {
      return $moments.children(moment_selector + '.' + moment_template_class).first();
    }

    function findMomentPlaceholder(moment) {
      var placeholder = moment.next();
      if(!placeholder.hasClass(placeholder_class)) {
        console.error("Can't find moment placeholder");
        console.log(placeholder);
      }
      return placeholder;
    }

    function addPlaceholderToMomentSelector(moment) {
      return moment.add(findMomentPlaceholder(moment));
    }

    // Scroll helpers
    function scrollToMoment(moment) {
      $(window).scrollTo($(moment), scroll_speed);
    }

    // Get FileList from input
    function getInputFiles(input) {
      if(input.length && input.length > 0) {
        input = input.get(0);
      }

      if(input.files !== undefined && input.files.length > 0) {
        return input.files;
      }

      return false;
    }

    // Date- and timepicker methods
    function attachDatetimePickers() {
      if($.isMobile()) {
        return; // We don't want costum date- and timepickers on mobile devices
      }

      // Datepickers
      $moments.find(datetime_form_date_input_selector).each(function(index, input) {
        var $this = $(input);
        if($this.hasClass('has-datepicker')) {
          return;
        }

        $this.addClass('has-datepicker');
        $this.attr('type', 'text');
        $this.attr('subtype', 'date');

        $this.datepicker({
          format: 'yyyy-mm-dd',
          startDate: '2000-01-01',
          endDate: Tools.getDate(), // Today
          weekStart: 1,
          todayBtn: true,
          todayHighlight: true
        });
      });

      // Timepickers
      $moments.find(datetime_form_time_input_selector).each(function(index, input) {
        var $this = $(input);
        if($this.hasClass('has-timepicker')) {
          return;
        }

        $this.addClass('has-timepicker');
        $this.attr('type', 'text');
        $this.attr('subtype', 'time');

        $this.timepicker({
          minuteStep: 5,
          template: false,
          isOpen: true,
          showMeridian: false
        });
      });
    }

    // Date and time helpers
    function getDatetime(moment) {
      var $moment = $(moment);
      var $form = $moment.find(datetime_form_selector);
      var $date_input = $form.find(datetime_form_date_input_selector);
      var $time_input = $form.find(datetime_form_time_input_selector);
      var $seconds_input = $form.find(datetime_form_seconds_input_selector);
      var $timezone_input = $form.find(datetime_form_timezone_selector);

      return Tools.createDateObject($date_input.val(), $time_input.val() + ':' + $seconds_input.val(), $timezone_input.val());
    }

    function getDatetimeISOString(moment) {
      var $moment = $(moment);
      var $form = $moment.find(datetime_form_selector);
      var $date_input = $form.find(datetime_form_date_input_selector);
      var $time_input = $form.find(datetime_form_time_input_selector);
      var $seconds_input = $form.find(datetime_form_seconds_input_selector);
      var $timezone_input = $form.find(datetime_form_timezone_selector);

      return $date_input.val() + 'T' + $time_input.val() + ':' + $seconds_input.val() + $timezone_input.val();
    }

    // Image transformations
    function setImage(moment, url_or_data_url, is_converted) {
      var $moment = $(moment);

      var $image_container = $moment.find(image_container_selector);
      var $image = $image_container.find(image_selector);
      var $submit_btn = $moment.find(image_action_edit_confirm_btn_selector);

      // Use preloading to remove "blinking" effect
      var tmp = new Image();
      tmp.onload = function() {
        // Reset element styles
        $image.css('width', '');
        $image.css('height', '');

        // Changing image
        $image.first().one('load', function() {
          $image.width($image.width());
          $image.height($image.height());

          if(!is_converted) {
            $image_container.addClass(image_has_changes_class);
            $submit_btn.removeClass('disabled');
          }

          if($image_container.hasClass(image_has_crop_tool_class)) {
            $submit_btn.removeClass('disabled');
          }

          $moment.trigger('imagechanged', url_or_data_url, is_converted);
        });

        $image.attr('src', url_or_data_url).each(function() {
          if(this.complete) {
            $(this).load(); // Fix cached images issue
          }
        });
      };

      tmp.onerror = function() {
        console.log("Can't preload new image contents");
      };

      tmp.src = url_or_data_url;
    }

    // Rotation
    function rotateImage(moment, orientation) {
      var $moment = $(moment);
      var $image_container = $moment.find(image_container_selector);
      var $image = $image_container.find(image_selector);

      var converter = ImageTools.Convert.imageToDataURL($image.attr('src'));
      converter.done(function(data_url) {
        ImageTools.Transform.rotate(data_url, orientation).done(function(rotated_data_url) {
          setImage($moment, rotated_data_url);
        });
      });

      converter.fail(function() {
        alert("Can't convert image");
      });
    }

    function showCropTool(moment) {
      var $moment = $(moment);
      var $image_container = $moment.find(image_container_selector);
      var $image = $image_container.find(image_selector);
      var $crop_btn = $moment.find(image_action_crop_btn_selector);
      var $submit_btn = $moment.find(image_action_edit_confirm_btn_selector);

      function isAttached() {
        return $moment.find(jcrop_holder_selector).length > 0;
      }

      function cordsSave(cords) {
        $image.data('crop-select', [cords.x, cords.y, cords.x2, cords.y2, cords.w, cords.h]);
      }

      function cordsLoad() {
        return $image.data('crop-select');
      }

      function cordsRemove() {
        $image.removeData('crop-select');
      }

      if($crop_btn.hasClass('disabled')) {
        return;
      }

      $crop_btn.addClass('disabled');

      if(isAttached()) {
        console.log('This image already have crop tool');
        return;
      }

      var cropDismiss = function(crop_api) {
        $moment.off('.cropper');
        cordsRemove();
        crop_api.destroy();
        $crop_btn.removeClass('disabled');
        $image_container.removeClass(image_has_crop_tool_class);

        if(!$image_container.hasClass(image_has_changes_class)) {
          $submit_btn.addClass('disabled');
        }
      };

      var onCropReady = function() {
        var crop_api = this;

        var data_select = cordsLoad($image);
        if(!data_select) {
          data_select = [0, 0, image_width, image_height];
        }

        crop_api.setSelect(data_select);

        $crop_btn.one('click', function(event) {
          event.stopPropagation(); // Don't hit crop button again
          cropDismiss(crop_api);
        });

        $moment.on('imagechanged.cropper', function(event, data_url) {
          if(isAttached()) {
            crop_api.redraw(function() {
              crop_api.setSelect(cordsLoad($image));
            });
            // crop_api.setImage(data_url); // This is right, but produce bugs
          } else {
            $moment.off('.cropper');
          }
        });

        $moment.one('imagesave.cropper', function(event) {
          if(!isAttached()) {
            $moment.off('.cropper');
            return;
          }

          // This code stops imagesave event and fies it again after crop tool removed, so saved data is always cropped
          event.stopImmediatePropagation();

          var crop_select = cordsLoad($image);
          var params = {
            x: crop_select[0],
            y: crop_select[1],
            x2: crop_select[2],
            y2: crop_select[3],
            cropWidth: crop_select[4],
            cropHeight: crop_select[5],
            scaledImageWidth: $image.width(),
            scaledImageHeight: $image.height()
          };

          ImageTools.Transform.crop($image.attr('src'), params).done(function(cropped_data_url) {
            setImage($moment, cropped_data_url);

            $moment.one('imagechanged', function(e, cbdata) {
              cropDismiss(crop_api);
              $moment.trigger('imagesave');
            });
          });
        });
      };

      // Convert image to data_url before editing
      ImageTools.Convert.imageToDataURL($image.attr('src')).done(function(data_url) {
        // Enshure that cropped attached on data_url'ed image
        $moment.one('imagechanged', function() {

          // Show crop tool
          $image.Jcrop({
            aspectRatio: image_width/image_height,
            keySupport: false,
            boxWidth: $image.width(),
            onSelect: cordsSave,
            onChange: cordsSave, // Remove to dont spam data-api
            allowSelect : false // This is undocumented feature
          }, onCropReady);
        });

        $image_container.addClass(image_has_crop_tool_class);
        setImage($moment, data_url, true);
      });
    }

    // Moments helpers
    function insertMoment(moment) { // This method can move or insert moment DOM
      var $moment = $(moment);

      if(!$moment.is(moment_selector)) {
        console.error("insertMoment takes only ." + moment_selector + " as param, given: ", moment);
        return false;
      }

      var $moment_and_placeholder = addPlaceholderToMomentSelector($moment);
      var moment_datetime = getDatetime($moment);

      var found = false;
      $moments.find(moment_selector).each(function() {
        var $sibling_moment = $(this);
        if($sibling_moment.is($moment)) {
          return;
        }

        var sibling_moment_datetime = getDatetime($sibling_moment);

        if(moment_datetime < sibling_moment_datetime) {
          $moment_and_placeholder.insertBefore($sibling_moment);

          found = true;
          return false; // Breaks each
        }
      });

      if(!found) {
        $moments.append($moment_and_placeholder);
      }

      attachDatetimePickers();

      return $moment;
    }

    function deleteMoment(moment, callback) {
      var $moment_and_placeholder = addPlaceholderToMomentSelector(moment);

      $moment_and_placeholder.animate({opacity: 0}, animations_speed, function() {
        $moment_and_placeholder.remove();

        if(callback !== undefined) {
          callback();
        }
      });
    }

    // Editing existing moments
    (function() {
      // Delete
      $moments.on('click', delete_btn_selector, function() {
        if(confirm("Do you really want to delete this moment?")) {
          var $moment = getMomentByContext(this);
          var $moment_and_placeholder = addPlaceholderToMomentSelector($moment);
          var moment_id = $moment.data('moment-id');

          $moment_and_placeholder.animate({opacity:0.5}, animations_speed);

          var delete_request = API.request('POST', '/moments/' + moment_id + '/delete');
          delete_request.success(function() {
            deleteMoment($moment);
          });

          delete_request.error(function() {
            $moment_and_placeholder.animate({opacity:1}, animations_speed, function() {
              alert("We can't delete moment right now, please try again later or tell us about this issue");
            });
          }, true);

          delete_request.send();
        }
      });

      // Edit description
      $moments.on('keyup', description_form_selector + ' ' + description_form_input_selector, function() {
        var $this = $(this);
        var $form = $this.closest(description_form_selector);
        var $submit_btn = $form.find(description_form_submit_btn_selector);
        $submit_btn.removeClass('disabled').addClass('btn-success');
      });

      $moments.on('submit', description_form_selector, function() {
        var $form = $(this);
        var $submit_btn = $form.find(description_form_submit_btn_selector);

        if($submit_btn.hasClass('disabled')) {
          return false;
        }

        var $input = $form.find(description_form_input_selector);
        var $moment = getMomentByContext($form);

        var moment_id = $moment.data('moment-id');

        $submit_btn.addClass('disabled');
        $submit_btn.showSpinner();
        $input.prop("disabled", true);

        var description_request = API.request('POST', '/moments/' + moment_id + '/update', {
          description: $input.val()
        });

        description_request.success(function() {
          $submit_btn.hideSpinner();
          $input.prop("disabled", false);
          $submit_btn.addClass('disabled').removeClass('btn-success btn-danger');

          var $next_moment = findNextMoment($moment);

          if($next_moment.length > 0) {
            scrollToMoment($next_moment);
            $next_moment.find(description_form_selector).find(description_form_input_selector).focus();
          } else {
            var $day_final_description_form = $day.find(day_final_description_form_selector);
            var $day_final_description_form_input = $day_final_description_form.find(day_final_description_form_input_selector);
            scrollToMoment($day_final_description_form);
            $day_final_description_form_input.focus();
          }
        });

        description_request.error(function() {
          $submit_btn.hideSpinner();
          $submit_btn.addClass('btn-danger').removeClass('btn-success disabled');
        });

        description_request.send();

        return false;
      });

      // Changing day cover
      $moments.on('click', image_action_use_as_cover_btn_selector, function() {
        if($(this).hasClass('disabled')) {
          return false;
        }

        if(confirm("Select this moment image as day cover?")) {
          var $moment = getMomentByContext($(this));
          var $image_container = $moment.find(image_container_selector);
          var $image_toolbar = $image_container.find(image_toolbar_selector);

          var moment_id = $moment.data('moment-id');

          if(!moment_id) {
            console.error("Can't find moment id to select day cover");
            return false;
          }

          // Remove all states on use-as-cover buttons
          $moments.find(image_action_use_as_cover_btn_selector + ':not(.' + moment_template_class + ')').removeClass('disabled show-overlap');
          // Add disabled states on use-as-cover buttons in current moment
          var $cover_btn = $moment.find(image_action_use_as_cover_btn_selector);
          $cover_btn.addClass('disabled');
          $image_toolbar.addClass(image_toolbar_expanded_class);

          var cover_request = API.request('POST', '/days/' + day_data.id + '/update', {
            cover_moment_id: moment_id
          });

          cover_request.success(function(response) {
            $cover_btn.addClass('show-overlap');
            $('meta[property="og:image"]').prop('content', response.data.result.image_532);
            setTimeout(function() {
              $image_toolbar.removeClass(image_toolbar_expanded_class);
            }, 1000);
          });

          cover_request.error(function() {
            $cover_btn.removeClass('disabled');
            alert("We wasn't able to select day cover");
          }, true);

          cover_request.send();
        }
      });

      // Editing time
      $moments.on('change keyup', datetime_form_selector + ' ' + datetime_form_date_input_selector, function() {
        $(this).closest(datetime_form_selector).find(datetime_form_submit_btn_selector).removeClass('disabled').addClass('btn-success');
      });

      $moments.on('change keyup', datetime_form_selector + ' ' + datetime_form_time_input_selector, function() {
        $(this).closest(datetime_form_selector).find(datetime_form_submit_btn_selector).removeClass('disabled').addClass('btn-success');
      });

      $moments.on('submit', datetime_form_selector, function() {
        var $form = $(this);
        var $submit_btn = $form.find(datetime_form_submit_btn_selector);

        if($submit_btn.hasClass('disabled')) {
          return false;
        }

        $submit_btn.addClass('disabled');
        $submit_btn.showSpinner();

        var $date_input = $form.find(datetime_form_date_input_selector);
        var $time_input = $form.find(datetime_form_time_input_selector);

        var $date_and_time_inputs = $date_input.add($time_input);

        $date_and_time_inputs.prop('disabled', true);

        var $moment = getMomentByContext($form);
        var moment_id = $moment.data('moment-id');

        var moment_datetime_request = API.request('POST', '/moments/' + moment_id + '/update', {
          time: getDatetimeISOString($moment)
        });

        moment_datetime_request.success(function() {
          $submit_btn.hideSpinner();
          $moment.trigger('datetimechange');
          $date_and_time_inputs.prop('disabled', false);
          $submit_btn.addClass('disabled').removeClass('btn-success btn-danger');
        });

        moment_datetime_request.error(function() {
          $submit_btn.hideSpinner();
          $submit_btn.addClass('btn-danger').removeClass('btn-success');
        });

        moment_datetime_request.send();

        return false;
      });

      $moments.on('datetimechange', moment_selector, function() {
        scrollToMoment(insertMoment($(this)));
      });

      // Editing image itself
      (function() {
        $moments.on('imagesave', moment_selector, function() {
          var $moment = $(this);

          var $image_container = $moment.find(image_container_selector);
          var $image = $image_container.find(image_selector);
          var $submit_btn = $moment.find(image_action_edit_confirm_btn_selector);

          if($submit_btn.hasClass('disabled')) {
            return;
          }

          $submit_btn.addClass('disabled');
          $submit_btn.showSpinner();

          ImageTools.Convert.dataURLToBase64($image.attr('src')).done(function(base64) {
            var moment_image_request = API.request('POST', '/moments/' + $moment.data('moment-id') + '/update', {
              image_content: base64
            });

            moment_image_request.success(function(response) {
              $moment.one('imagechanged', function() {
                $submit_btn.hideSpinner();
                $submit_btn.addClass('disabled btn-success').removeClass('btn-danger');

                $moment.trigger('imagesaved');
              });

              setImage($moment, response.data.result.image_532 + '?=' + new Date().getTime());
            });

            moment_image_request.error(function() {
              $submit_btn.hideSpinner();
              $submit_btn.addClass('btn-danger').removeClass('btn-success disabled');
            });

            moment_image_request.send();
          });
        });

        $moments.on('imagesaved', moment_selector, function() {
          $(this).find(image_container_selector).removeClass(image_has_changes_class);
        });

        $moments.on('click', image_action_edit_confirm_btn_selector, function() {
          var $moment = getMomentByContext(this);
          var $submit_btn = $moment.find(image_action_edit_confirm_btn_selector);

          if($submit_btn.hasClass('disabled')) {
            return;
          }

          $moment.trigger('imagesave');
        });

        // Crop
        $moments.on('click', image_action_crop_btn_selector, function() {
          showCropTool(getMomentByContext(this));
        });

        $moments.on('click', image_action_rotate_right_btn_selector, function() {
          rotateImage(getMomentByContext(this), 'right');
        });

        $moments.on('click', image_action_rotate_left_btn_selector, function() {
          rotateImage(getMomentByContext(this), 'left');
        });
      })();
    })();
  })();
});
