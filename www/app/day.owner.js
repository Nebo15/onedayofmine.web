$(function() {
  "use strict";

  // Tools to work with images
  var FileReaderFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

  var proxy_path = '/proxy?source=';
	var min_width = 532;
	var min_height = 532;

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

	var Speech = {

		recognition: null,

		show: function($button) {
			$button.removeClass('hidden');
		},

		createRecognizer: function() {
			this.recognition = new webkitSpeechRecognition();
			this.recognition.continuous = true;
			this.recognition.interimResults = true;
			this.recognition.lang = 'ru-RU';
			this.recognition.interim_length = 0;
			this.recognition.onerror = function(event) { console.log('speech error', event); }
		},

		onResultWriteToTextarea: function(event, $textarea) {
			var final_transcript = '';
			var interim_transcript = '';
			var current_desc = $textarea.val();
			$textarea.val(current_desc.substr(0, current_desc.length - this.recognition.interim_length));

			for (var i = event.resultIndex; i < event.results.length; ++i) {
				if (event.results[i].isFinal) {
					final_transcript += this.replaceSpecialWords(event.results[i][0].transcript);
					this.recognition.interim_length = 0;
				} else {
					interim_transcript += this.replaceSpecialWords(event.results[i][0].transcript);
				}
			}

			$textarea.val($textarea.val() + final_transcript);
			if(interim_transcript.length > 0)
			{
				interim_transcript += '…';
				$textarea.val($textarea.val() + interim_transcript);
				this.recognition.interim_length = interim_transcript.length;
			}
		},

		replaceSpecialWords: function(text) {
			var replaces = [
				['точка',  '.'],
				['запятая',  ','],
				['новая строка', "\n"]
			]
			$.each(replaces, function(i, replacement) {
				var regexp = new RegExp(replacement[0], "i");
				text = text.replace(regexp, replacement[1]);
			});
			return text;
		},

		buttonClick: function($button) {
			if($button.hasClass('icon-microphone')) {
				this.recognition.start();
				$button.removeClass('icon-microphone').addClass('icon-microphone-off');
			} else {
				this.recognition.stop();
				$button.removeClass('icon-microphone-off').addClass('icon-microphone');
			}
		}
	}

  // Main container selector
  var $day = $('.day');

  // Selector string that is used globally
  var day_description_form_input_selector = 'input[name=description]';
  var day_description_form_submit_btn_selector = '.btn[type=submit]';

  // Day info editing
  (function() {

    // Controls containers
    var $controls = $day.find('header .day-controls-group');
    var $toolbar = $day.find('.day-toolbar');


    // Day form
    var $day_form = $controls.find('form[name=day]');
		var $day_form_submit = $day_form.find('button[type=submit]');
    var $title_input = $day_form.find('input[name=title]');
		var $description_input = $day_form.find('textarea[name=description]');
    var $date_input = $day_form.find('input[name=date]');
		var $description_speech_button = $day_form.find('i.speech-action');
		var is_form_valid = true;

		if ('webkitSpeechRecognition' in window) {
			Speech.createRecognizer();
			Speech.show($description_speech_button);
			Speech.recognition.onresult = function(event) {
				Speech.onResultWriteToTextarea(event, $description_input);
			}
			$description_speech_button.click(function() { Speech.buttonClick($description_speech_button)} );
		}

		$title_input.attachValidator({
      button: $day_form_submit,
      saveValidationState: true,
      minLength: 3,
      maxLength: 100,
      messages: {
        empty: "Title should not be empty",
        minLength: "Title should be longer than 3 characters",
        maxLength: "Title should not be longer than 100 characters"
      },
      onError: function() {
				$day_form_submit.prop("disabled", true);
				$day_form_submit.removeClass('btn-success').addClass('disabled');
      },
      onSuccess: function() {
				$day_form_submit.prop("disabled", false);
				$day_form_submit.addClass('btn-success').removeClass('disabled');
      }
    });

		$day_form.find(':input').on('keyup', function() {
			$day_form_submit.removeClass('disabled').addClass('btn-success');
		});

		$day_form.submit(function(event)
		{
      if($day_form_submit.hasClass('disabled')) {
        return false;
      }

      $title_input.prop("disabled", true);
			$date_input.prop("disabled", true);
      $description_input.prop("disabled", true);
			$day_form_submit.addClass('disabled');
			$day_form_submit.showSpinner();

      var day_title_request = API.request('POST', '/days/' + day_data.id + '/update', {
        title: $title_input.val(),
        date: $date_input.val(),
				final_description: $description_input.val()
      });

      day_title_request.success(function() {
				$day_form_submit.hideSpinner();
        $title_input.prop("disabled", false);
        $date_input.prop("disabled", false);
        $description_input.prop("disabled", false);
        $('meta[property="og:title"]').prop('content',  $title_input.val());
				$day_form_submit.addClass('disabled').removeClass('btn-success btn-danger');
      });

      day_title_request.error(function() {
				$day_form_submit.hideSpinner();
        $title_input.prop("disabled", false);
        $date_input.prop("disabled", false);
        $description_input.prop("disabled", false);
				$day_form_submit.addClass('btn-danger').removeClass('btn-success disabled');
      });

      day_title_request.send();

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
    var create_btn_selector = '.action-create';
    var image_container_selector = ".image";
    var image_selector = ".thumbnail img";

    var position_form_selector = '.action-position';
    var position_form_increment_selector = '.spinner-up';
    var position_form_decrement_selector = '.spinner-down';
    var position_form_indicator_selector = '.spinner-value';

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
    var image_toolbar_hidden_class = 'hide';
    var image_action_edit_confirm_btn_selector = '.action-edit-confirm';

    var image_action_use_as_cover_btn_selector = '.action-use-as-cover';
    var image_action_rotate_left_btn_selector = '.action-rotate-left';
    var image_action_rotate_right_btn_selector = '.action-rotate-right';
    var image_action_crop_btn_selector = '.action-crop';

    var jcrop_holder_selector = '.jcrop-holder';

    // Params
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

    // Lookup methods
    function getMomentByContext(context) {
      return $(context).closest(moment_selector);
    }

    function findNextMoments(moment) {
      return $(moment).nextAll(moment_selector);
    }

    function findNextMoment(moment) {
      return findNextMoments(moment).first();
    }

    function findPrevMoments(moment) {
      return $(moment).prevAll(moment_selector);
    }

    function findPrevMoment(moment) {
      return findPrevMoments(moment).first();
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
    function scrollToMoment(moment, instant) {
      $(window).scrollTo($(moment), instant == true ? 0 : scroll_speed);
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

    // Position helpers
    function getPosition(moment) {
      var $moment = $(moment);
      var $value = $moment.find(position_form_selector).find(position_form_indicator_selector);
      var position = parseInt($value.val(), 10);

      return isNaN(position) || !position || position < 0 ? 0 : position;
    }

    function setPosition(moment, position) {
      var $moment = $(moment);
      $moment.find(position_form_selector).find(position_form_indicator_selector).val(parseInt(position, 10));
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

				if(tmp.width < min_width || tmp.height < min_height)
				{
					alert('Too small image. We need at least 532x532 pixels.');
					return;
				}

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
          $moments.trigger('momentschanged', {moment: $moment});
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
      var def = $.Deferred();

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

			function calculateSelectionInitialCoords(image_width, image_height)
			{
				var frame_width = $image.width() <= $image.height()
						? image_width : image_width / $image.width() * $image.height();
				var frame_height = $image.width()  <= $image.height()
						? image_height : image_height / $image.width() * $image.height();
				var fx1 = $image.width() / 2 - frame_width / 2;
				var fy1 = $image.height() / 2 - frame_height / 2;
				return [fx1, fy1, fx1 + frame_width, fy1 + frame_height];
			}

      if($crop_btn.hasClass('disabled')) {
        def.reject();
        return def.promise();
      }

      $crop_btn.addClass('disabled');

      if(isAttached()) {
        console.log('This image already have crop tool');
        def.reject();
        return def.promise();
      }

      var cropDismiss = function(crop_api) {
        $moment.off('.cropper');
        $crop_btn.off('.cropper');
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

        $crop_btn.one('click.cropper', function(event) {
          if(isAttached()) {
            event.stopPropagation(); // Don't hit crop button again
            cropDismiss(crop_api);
          }
        });

        $moment.on('imagechanged.cropper', function(event, data_url) {
          if(isAttached()) {
            crop_api.redraw(function() {
              crop_api.setSelect(calculateSelectionInitialCoords(image_width, image_height));
            });
            // crop_api.setImage(data_url); // This is right, but produce bugs
          } else {
            $moment.off('.cropper');
            $crop_btn.off('.cropper');
          }
        });

        $moment.one('imagesave.cropper', function(event) {
          if(!isAttached()) {
            $moment.off('.cropper');
            $crop_btn.off('.cropper');
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
            boxWidth: image_width,
						setSelect: calculateSelectionInitialCoords(image_width, image_height),
            onSelect: cordsSave,
            onChange: cordsSave, // Remove to dont spam data-api
            allowSelect : false // This is undocumented feature
          }, onCropReady);
        });

        $image_container.addClass(image_has_crop_tool_class);
        setImage($moment, data_url, true);

        def.resolve();
      });

      return def.promise();
    }

    // Moments helpers
    function insertMoment(moment) { // This method can move or insert moment DOM
      var $moment = $(moment);

      if(!$moment.is(moment_selector)) {
        console.error("insertMoment takes only ." + moment_selector + " as param, given: ", moment);
        return false;
      }

      var $moment_and_placeholder = addPlaceholderToMomentSelector($moment);
      var moment_position = getPosition($moment);

      var found = false;
      $moments.find(moment_selector).each(function() {
        var $sibling_moment = $(this);
        if($sibling_moment.is($moment)) {
          return;
        }

        var sibling_moment_position = getPosition($sibling_moment);

        if(moment_position <= sibling_moment_position) {
          $moment_and_placeholder.insertBefore($sibling_moment);

          found = true;
          return false; // Breaks each
        }
      });

      if(!found) {
        $moments.append($moment_and_placeholder);
      }

      findNextMoments($moment).each(function() {
        var $next_moment = $(this);
        setPosition($next_moment, getPosition($next_moment) + 1);
      });

      $moments.trigger('momentschanged', {moment: $moment});

      return $moment;
    }

    function deleteMoment(moment, callback) {
      var $moment_and_placeholder = addPlaceholderToMomentSelector(moment);

      $moment_and_placeholder.animate({opacity: 0}, animations_speed, function() {
        $moment_and_placeholder.remove();

        $moments.trigger('momentschanged', {moment: $(moment)});

        if(callback !== undefined) {
          callback();
        }
      });
    }

    function moveMoment(moment, position, callback) {
      var $moment = $(moment);
      setPosition($moment, position);

      var offset = $(window).scrollTop() - $moment.offset().top;
      insertMoment($moment);
      offset += $moment.offset().top;

      $(window).scrollTop(offset);
      if(typeof callback === 'function') {
        callback($moment, position);
      }
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
        } else {
          $(this).removeClass('disabled active');
        }
      });

      // Editing position
      (function() {
        var saveMomentPosition = (function() {
          var request_timeouts = {};

          return function(moment, position) {
            var $moment = $(moment);
            var moment_id = $moment.data('moment-id');

            if(!moment_id) {
              return;
            }

            if(!position) {
              position = getPosition($moment);
            }

            var position_request = API.request('POST', '/moments/' + moment_id + '/update', {
              position: position
            })

            position_request.error(function() {
              alert("Can't save moment position, try to reload the page and move it again");
            });

            clearTimeout(request_timeouts[moment_id]);
            request_timeouts[moment_id] = setTimeout(function() {
              position_request.send();
            }, 1000);
          };
        })();

        $moments.on('click', position_form_selector + ' ' + position_form_increment_selector, function() {
          var $moment = getMomentByContext(this);
          var $next_moment = findNextMoment($moment);

          moveMoment($moment, getPosition($next_moment) + 1, saveMomentPosition);
        });

        $moments.on('click', position_form_selector + ' ' + position_form_decrement_selector, function() {
          var $moment = getMomentByContext(this);
          var $prev_moment = findPrevMoment($moment);

          moveMoment($moment, getPosition($prev_moment), saveMomentPosition);
        });

        // React on previews reordering
        $moments.on('sortupdate', function(event, data) {
          var $moment = $(data.moment);
          var position = data.position ? data.position : getPosition($moment);
          setPosition($moment, position);
          saveMomentPosition($moment, position);
          insertMoment($moment);
        });
      })();

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

    // Creating new moments
    (function() {
      function createMoment(params, callback) {
        function createImageSelectPopover($moment) {
          var is_mobile = $(window).width() < 800 || $.isMobile();

          var popover_params = {
            html: true,
            trigger: 'manual',
            position: 1,
            title: 'Select file',
            content: is_mobile ? image_select_popover_mobile_template : image_select_popover_template,
            placement: is_mobile ? 'bottom' : 'right'
          };

          var $image_container = $moment.find(image_container_selector);
          var $image = $image_container.find(image_selector);
          $image.popover(popover_params);

          $image.on('shown', function() {
            var $file_input = $image_container.find(image_select_popover_file_input_selector);

            $file_input.on('change', function() {
              if(is_mobile) {
                // On small screens popover take too many place to let user select images multiply times
                $image.popover('hide');
              }

              var files = getInputFiles($file_input);
              if(files && files.length > 0) {
                var converter =  ImageTools.Convert.fileToDataURL(files[0]);
                converter.done(function(data_url) {
                  setImage($moment, data_url);
                });

                converter.fail(function() {
                  alert("Can't receive local image contents, try again later or try to pick different image");
                });
              } else {
                console.log('File not selected');
              }
            });
          });

          $image.one('load', function() {
            $image.popover('show');
          });
        }

        // Default data
        params = $.extend({
          date: Tools.getDate(),
          time: Tools.getTime(),
          time_seconds: Tools.getSeconds(),
          timezone: Tools.getTimezone(),
          image: '',
          description: ''
        }, params);

        var converter = ImageTools.Convert.imageToDataURL(params.image);
        converter.done(function(data_url) {
          params.image = data_url;
        });

        converter.always(function() {
          var $moment_and_placeholder = $($.parseHTML(Template.compileElement(moment_template, {
            moment: params
          })));

          var $moment = $moment_and_placeholder.filter(moment_selector);
          var $placeholder = $moment_and_placeholder.filter(placeholder_selector);

          bindTooltips($moment_and_placeholder);

          insertMoment($moment);

          // Selectors
          var $delete_btn = $moment.find(delete_btn_selector);
          var $position_form = $moment.find(position_form_selector);
          var $position_form_indicator = $position_form.find(position_form_indicator_selector);
          var $position_form_increment_btn = $position_form.find(position_form_increment_selector);
          var $position_form_decrement_btn = $position_form.find(position_form_decrement_selector);
          var $description_form = $moment.find(description_form_selector);
          var $description_form_input = $moment.find(description_form_input_selector);
          var $description_form_submit_btn = $description_form.find(description_form_submit_btn_selector);
          var $image_container = $moment.find(image_container_selector);
          var $image_toolbar = $image_container.find(image_toolbar_selector);
          var $image = $image_container.find(image_selector);
          var $image_wrap = $image.parent();

          // Elements with overrided event handlers
          var $has_event_handlers = $moment.add($position_form).add($position_form_increment_btn).add($position_form_decrement_btn).add($description_form).add($delete_btn).add($image).add($description_form_input);

          // Attach moment template events
          (function() {
            $moment.on('imagechanged.adder', function() {
              $moment.removeClass(moment_without_image_class);
              $description_form_submit_btn.removeClass('disabled').addClass('btn-success');

              // TODO autofix orientation
              // console.log(exif.Orientation);

              // show crop tool if aspect ration != 1
              if($image.width() / $image.height() != image_width / image_height) {
                showCropTool($moment);
              }

              $moment.find(image_action_edit_confirm_btn_selector).addClass('disabled');

              // Fix image popover position
              var $popover = $image_container.find(image_select_popover_selector);
              $popover.css('top', ($image.height()/2 - $popover.height()/2) + 'px');
            });


            // Edit moment description
            $description_form_input.on('keyup.adder', function() {
              event.stopPropagation();

              if(!$moment.hasClass(moment_without_image_class)) {
                $description_form_submit_btn.removeClass('disabled').addClass('btn-success');
              }
            });

            // Delete
            $delete_btn.on('click.adder', function(event) {
              event.stopPropagation(); // Event don't hit delegated handlers

              if(confirm("Do you really want to delete this moment?")) {
                deleteMoment(getMomentByContext(this));
              }
            });

            $moment.on('imageselect.adder', function(event, image_or_data_url) {
              var converter = ImageTools.Convert.imageToDataURL(image_or_data_url);
              converter.done(function(data_url) {
                setImage(data_url);
              });

              converter.fail(function() {
                console.error('Image or data url: ', image_or_data_url);
                alert("Can't recieve image contents, try again later or try to pick diffrent image");
              });
            });

            // Save moment
            $description_form.on('submit.adder', function(event) {
              event.stopPropagation(); // Event don't hit delegated handlers

              if($moment.hasClass(moment_without_image_class)) {
                $image_wrap.addClass('error');
                $description_form_submit_btn.removeClass('btn-success btn-danger').addClass('disabled');
                return false;
              }

              if($description_form_submit_btn.hasClass('disabled')) {
                return false;
              }

              if(!$image_container.hasClass(image_has_crop_tool_class)) {
                // show crop tool if aspect ration != 1
                if($image.width() / $image.height() != image_width / image_height) {
                  console.log('Forse user to crop image');

                  var crop_tool = showCropTool($moment);
                  crop_tool.always(function() {
                    $(window).scrollTo($moment.find(jcrop_holder_selector), scroll_speed);
                    $image_wrap.addClass('error');
                  });

                  return false;
                }
              }

              $image_wrap.removeClass('error');

              $description_form_submit_btn.addClass('disabled');
              $description_form_submit_btn.showSpinner();

              var $popover = $image_container.find(image_select_popover_selector);

              // Inputs to be disabled
              var $file_input = $popover.find(image_select_popover_file_input_selector);
              var $inputs = $description_form_input.add($file_input);

              // Buttons to be disabled
              var $popover_btns = $popover.find(image_select_popover_btns_selector);

              // Upload progress bar
              var $upload_progress = $($.parseHTML(image_upload_progress_template));
              var $upload_progress_bar = $upload_progress.find(image_upload_progress_bar_selector);

              $upload_progress.fadeOut(0);

              $popover_btns.addClass('disabled');
              $inputs.prop('disabled', true);
              $image_toolbar.addClass(image_toolbar_hidden_class);
              $position_form.find(position_form_decrement_selector).addClass('disabled');
              $position_form.find(position_form_increment_selector).addClass('disabled');

              // Don't use default save event handler
              $moment.on('imagesave.adder', function(save_event) {
                save_event.stopPropagation();
                $moment.trigger('imagesaved');
              });

              // When editings ended
              $moment.on('imagesaved.adder', function() {
                scrollToMoment($moment);

                ImageTools.Convert.dataURLToBase64($image.attr('src')).done(function(base64) {
                  var create_request_params = {
                    description: $description_form_input.val(),
										position: $position_form_indicator.val(),
                    image_content: base64
                  };

                  $(['instagram', 'flickr', 'facebook']).each(function(index, value) {
                    var id = $moment.data(value + '-id');
                    if(id !== undefined) {
                      create_request_params[value + '_id'] = id;
                    }
                  });

                  var save_request = API.request('POST', '/days/' + day_data.id + '/add_moment', create_request_params);

                  $image.after($upload_progress);
                  $upload_progress.css('top', (($image.height()-10)/2) + 'px');
                  $upload_progress.fadeIn(animations_speed);

                  save_request.params.progress = function(event) {
                    if(event.lengthComputable) {
                      $upload_progress_bar.css('width', ((event.loaded / event.total) * 95) + '%');
                    }
                  };

                  save_request.success(function(response) {
                    $upload_progress_bar.css('width', '95%');

                    $upload_progress.fadeOut(animations_speed, function() {
                      $upload_progress.detach();
                    });

                    // Set moment_id
                    $moment.attr('data-moment-id', response.data.result.id);

                    // Set image to link
                    setImage($moment, response.data.result.image_532, true);

                    $moment.one('imagechanged.adder', function() {
                      $image.animate({opacity: 1}, animations_speed);

                      // Re-enable everything
                      $description_form_submit_btn.removeClass('btn-danger btn-success');
                      $moment.removeClass('template');

                      // Remove template class
                      $moment.removeClass('template');

                      // Detach all tmp events
                      $moment.find('*').addBack().off('.adder');
                      $has_event_handlers.off();

                      // Change button text
                      $description_form_submit_btn.html('<span class="spinner icon-spin icon-refresh"></span> Save description');
                      $description_form_submit_btn.addClass('disabled');

                      // Destroy file select popover
                      $image.popover('destroy');

                      // Let user select image as day cover
                      $moment.find(image_action_use_as_cover_btn_selector).removeClass('disabled');

                      // Notify about changes
                      $moments.trigger('momentschanged', {moment: $moment});
                    });
                  });

                  save_request.error(function() {
                    $description_form_submit_btn.addClass('btn-danger').removeClass('disabled btn-success');
                  });

                  save_request.complete(function() {
                    // Re-enable everything
                    $popover_btns.removeClass('disabled');
                    $inputs.prop('disabled', false);
                    $description_form_submit_btn.hideSpinner();
                    $image_toolbar.removeClass(image_toolbar_hidden_class);
                    $image_container.removeClass(image_has_crop_tool_class);
                    $image_container.removeClass(image_has_changes_class);
                    $position_form.find(position_form_decrement_selector).removeClass('disabled');
                    $position_form.find(position_form_increment_selector).removeClass('disabled');
                  });

                  $image.animate({
                    opacity: 0.25
                  }, animations_speed);

                  $upload_progress.fadeIn(animations_speed, function() {
                    save_request.send();
                  });
                });
              });

              // Finish all editings
              $moment.trigger('imagesave');

              return false;
            });
          })();

          if(!params.image) {
            // Popover for selecting moment image
            createImageSelectPopover($moment);
          } else {
            setImage($moment, params.image);
            // if(!$.isMobile()) {
            //   createImageSelectPopover($moment);
            // }
          }

          if(typeof callback === 'function') {
            callback($moment);
          }
        });
      }

      $moments.on('click', placeholder_selector + ' ' + create_btn_selector, function() {
        var $placeholder = $(this).closest(placeholder_selector);

        var $prev_moment = findPrevMoment($placeholder);
        var $next_moment = findNextMoment($placeholder);

        createMoment({
          position: $prev_moment.length > 0 ? getPosition($prev_moment) + 1 : getPosition($next_moment)
        });
      });

      // Drag and drop
      (function() {
        $moments.on('dragover', placeholder_selector, function(event) {
          event.stopPropagation();
          event.preventDefault();
          $(this).addClass('success');

          event.originalEvent.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
        });

        $moments.on('dragleave', placeholder_selector, function(event) {
          $(this).removeClass('success');
        });

        $moments.on('drop', placeholder_selector, function(event) {
          event.stopPropagation();
          event.preventDefault();

          var $placeholder = $(this).closest(placeholder_selector);
          var $prev_moment = findPrevMoment($placeholder);
          var $next_moment = findNextMoment($placeholder);

          $(this).removeClass('success');
          $moments.find(placeholder_selector).removeClass('info');

          // Feature: upload by dragging from another page
          // console.log(event.originalEvent.dataTransfer.getData('text/html'));

          var files = event.originalEvent.dataTransfer.files; // FileList object.

          var scrolled = false;
          function onMomentCreated($moment) {
            if(!scrolled) {
              scrollToMoment($moment);
              scrolled = true;
            }
          }

          function onDataURLRetrieved(file, data_url) {
            ImageTools.Convert.dataURLToExif(data_url).done(function(exif) {
              createMoment({
                position: $prev_moment.length > 0 ? getPosition($prev_moment) + 1 : getPosition($next_moment),
                image: data_url
              }, onMomentCreated);
            });
          }

          if(files && files.length > 0) {
            for (var i = 0, file; file = files[i]; i++) {
              ImageTools.Convert.fileToDataURL(file).done(function(data_url) {
                onDataURLRetrieved(file, data_url);
              });
            }
          }
        });

        // Don't open files in browser if user missed placeholder-box
        $(document).bind('dragover', function(event) {
          event.preventDefault();
          event.originalEvent.dataTransfer.dropEffect = 'none';
          $moments.find(placeholder_selector).addClass('info');
        });

        $(document).bind('drop dragleave dragend', function() {
          event.stopPropagation();
          event.preventDefault();
          $moments.find(placeholder_selector).removeClass('info success');
        });
      })();

      // Importing moments
      (function() {
        var import_btn_selector = '.action-import';

        var modal_selector = '.import-modal';
        var modal_shoot_selector = '.thumbnail';

        var modal_template       = $('#template_import_modal').html();
        var modal_shoot_template = Template.prepareTemplate($('#template_import_modal_shoot')); // Only shoot is handlebars template

        var $modal;

        var messages = [
          "Calculating white pixels…",
          "Wait, I'm checking out my Facebook",
          "Wait, I need to talk to mom",
          "It's better to dont know, trust me",
          "Enchanting your browser…",
          "Closed for dinner",
          "Entering new age…",
          "It's gonna be legen… wait for it…"
        ];

        function showModal(moment, importer) {
          if($modal) {
            $modal.remove();
          }

          $modal = $($.parseHTML(modal_template)).filter(modal_selector);
          $('body').append($modal);

          // Disable page scroll when modal is visible
          $modal.on('shown', function() {
            $('body').css('overflow', 'hidden');
          });

          $modal.on('hidden', function() {
            $('body').css('overflow', 'auto');
          });

          var $moment = $(moment);
          var $body = $modal.find('.modal-body');
          var $progress = $body.find('.import-progress');
          var $progress_message = $body.find('.text');
          var $progress_bar = $progress.find('.bar');
          var $container = $body.find('.import-container');
          var $shoots_container = $body.find('.thumbnails');

          var $paginate_prev_btn = $body.find('.action-paginate-prev');
          var $paginate_next_btn = $body.find('.action-paginate-next');

          $modal.modal('show');

          var shoot_selected = false;

          function setProgress(percents, callback) {
            $progress_bar.css('width', percents + '%');

            if(percents === 100) {
              setTimeout(function() {
                $progress.slideUp(animations_speed, callback);
              }, 500);
            } else if($progress.css('display') == 'none') {
              $progress_message.text(messages[Math.floor(Math.random()*messages.length)]);
              $progress.slideDown(animations_speed);
            }
          }

          // Bind events
          $modal.one('click', modal_shoot_selector, function() {
            var $shoot = $(this);
            var $image_container = $moment.find(image_container_selector);
            var $image = $image_container.find(image_selector);
            var data = $shoot.data('import');

            shoot_selected = true;
            $shoot.parent().siblings().animate({opacity:0.4}, animations_speed);

            $paginate_prev_btn.add($paginate_next_btn).addClass('disabled');

            $moment.data(importer.getSourceName() + '_id', data.id);

            if(data.title) {
              var $description_form_input = $moment.find(description_form_selector).find(description_form_input_selector);
              if(!$description_form_input.val()) {
                $description_form_input.val(data.title);
              }
            }

            var converter =  ImageTools.Convert.imageToDataURL(data.image);
            converter.done(function(data_url) {
              setImage($moment, data_url);

              $moment.one('imagechanged', function() {
                $modal.modal('hide');
              });
            });

            converter.fail(function() {
              alert("Can't recieve local image contents, try again later or try to pick diffrent image");
            });
          });

          // Faking progress bar
          var fake_progress = 1;
          var fake_progress_interval = setInterval(function() {
            fake_progress += Math.floor((Math.random()*5)+1);
            if(fake_progress < 80) {
              setProgress(fake_progress);
            } else {
              clearInterval(fake_progress_interval);
            }
          }, 300);

          function finishFakeProgress() {
            clearInterval(fake_progress_interval);
            setProgress(100);
          }

          // Animation for images
          function iterativeFadeIn(step_element) {
            if(shoot_selected) {
              return;
            }

            step_element.animate({opacity:1}, 200, function() {
              iterativeFadeIn(step_element.next());
            });
          }

          function showNewMoments() {
            var $new_shoots = $shoots_container.children().not('.visible');
            $new_shoots.addClass('visible');

            if($container.css('display') == 'none') {
              $container.slideDown(animations_speed, function() {
                iterativeFadeIn($new_shoots.first());
              });
            } else {
              iterativeFadeIn($new_shoots.first());
            }
          }

          var request_params = {
            // from: Math.floor(last_moment_date.getTime()/1000), TODO daydate
            // to:   Math.floor(first_moment_date.getTime()/1000)
          };

          // Callbacks
          var onPhotosRecieved = function(photos, next_callback, prev_callback) {
            $paginate_prev_btn.hideSpinner();
            $paginate_next_btn.hideSpinner();

            if(typeof prev_callback === 'function') {
              $paginate_prev_btn.removeClass('disabled').animate({opacity:1}, animations_speed);

              $paginate_prev_btn.click(function() {
                if($paginate_prev_btn.hasClass('disabled')) {
                  return;
                }

                $paginate_prev_btn.addClass('disabled');
                $paginate_prev_btn.showSpinner();

                prev_callback();
              });
            } else {
              $paginate_prev_btn.slideUp(animations_speed);
            }

            if(typeof next_callback === 'function') {
              $paginate_next_btn.removeClass('disabled').animate({opacity:1}, animations_speed);

              $paginate_next_btn.click(function() {
                if($paginate_next_btn.hasClass('disabled')) {
                  return;
                }

                $paginate_next_btn.addClass('disabled');
                $paginate_next_btn.showSpinner();

                next_callback();
              });

              $body.scroll(function() {
                if($paginate_next_btn.hasClass('disabled') || $paginate_next_btn.css('opacity') == '0') {
                  return;
                }

                var _this = $(this);
                var scrollBottom = _this.outerHeight() - _this[0].scrollHeight + _this.scrollTop();

                if(scrollBottom >= -30) {
                  $paginate_next_btn.click();
                }
              });

              if(photos.length === 0) {
                clearInterval(fake_progress_interval);

                $paginate_next_btn.addClass('disabled').animate({opacity:0}, animations_speed);
                $paginate_prev_btn.addClass('disabled').animate({opacity:0}, animations_speed).slideUp(animations_speed);

                next_callback().success(function(response) {
                  setProgress(100, function() {
                    if(response.data.result.length === 0) {
                      $modal.modal('hide');
                      alert("It seems that you dont have puctures in " + source);
                    }
                  });
                });

                return;
              }
            } else {
              $paginate_next_btn.animate({opacity:0}, animations_speed);
            }

            // If there are no photos removing select clause and trying to send query again
            if(photos.length === 0) {
              console.error('No photos');
            }

            $.each(photos, function(index, photo) {
              var $shoot = $($.parseHTML(Template.compileElement(modal_shoot_template, photo)));
              $shoot.find(modal_shoot_selector).attr('data-import', JSON.stringify(photo));

              $shoots_container.append($shoot);
            });

            finishFakeProgress();
            showNewMoments();
          };

          var onPrevPhotosRecieved = function(prev_photos) {
            $paginate_prev_btn.hideSpinner();
            if(prev_photos.length !== 0) {
              $paginate_prev_btn.removeClass('disabled').slideDown(animations_speed).animate({opacity:1}, animations_speed);

              $.each(prev_photos.reverse(), function(index, photo) {
                var $shoot = $($.parseHTML(Template.compileElement(modal_shoot_template, photo)));
                $shoot.find(modal_shoot_selector).attr('data-import', JSON.stringify(photo));

                $shoots_container.prepend($shoot);
              });

              showNewMoments();
            } else {
              $paginate_prev_btn.slideUp(animations_speed);
            }
          };

          var onNextPhotosRecieved = function(next_photos) {
            $paginate_next_btn.hideSpinner();
            if(next_photos.length !== 0) {
              $paginate_next_btn.removeClass('disabled').animate({opacity:1}, animations_speed);

              $.each(next_photos, function(index, photo) {
                var $shoot = $($.parseHTML(Template.compileElement(modal_shoot_template, photo)));
                $shoot.find(modal_shoot_selector).attr('data-import', JSON.stringify(photo));

                $shoots_container.append($shoot);
              });

              showNewMoments();
            } else {
              $paginate_next_btn.animate({opacity:0}, animations_speed);
            }
          };

          var request_callbacks = {
            onPrevPhotosRecieved: function(all_photos, new_photos) {
              onPrevPhotosRecieved(new_photos);
            },

            onNextPhotosRecieved: function(all_photos, new_photos) {
              onNextPhotosRecieved(new_photos);
            }
          };

          importer.getUserPhotos(function(photos, next_callback, prev_callback) {
            setProgress(95);
            onPhotosRecieved(photos, next_callback, prev_callback);
          }, request_params, request_callbacks);
        }

        $moments.on('click', import_btn_selector, function() {
          var $import_btn = $(this);
          var $moment = getMomentByContext($import_btn);
          var importer = new Importer($import_btn.data('source'));

          var onLoggedIn = function() {
            showModal($moment, importer);
          };

          var onLogInFailed = function() {
            alert("It seems that you declined authorization.");
          };

          if(!importer.isConnected()) {
            importer.login(onLoggedIn, onLogInFailed);
          } else {
            onLoggedIn();
          }
        });
      })();
    })();
  })();
});
