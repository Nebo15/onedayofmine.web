$(function () {
  "use strict";

  // Day container
  var $day = $('.day');

	// Comments
	(function() {
		// Container
		var $comments = $day.find('.comments');
		var $comments_counter = $comments.find('.counter');

		// List
		var $comments_list = $comments.find('.articles');
		var $comments_load_next_btn = $comments.find('.action-load-next');

		var comment_delete_btn_selector = '.action-delete';
		var $comment_delete_btn = $comments_list.find(comment_delete_btn_selector);

		// JS Template
		var comments_template = Template.prepareTemplate($('#template_comments'));

		// Comments counter helpers
		var getCommentsCounter = function() {
			var text = $comments_counter.text();
			return parseInt(text.substring(text.indexOf('/')+1), 10);
		};

		var setCommentsCounter = function(value, callback) {
			var real_count = $comments_list.children().length;

			if(real_count > value) {
				$comments_load_next_btn.animate({opacity: 0}, 500, function() {
					$comments_load_next_btn.addClass('disabled');
				});
				value = real_count;
			} else if(real_count < value) {
				$comments_load_next_btn.animate({opacity: 1}, 500, function() {
					$comments_load_next_btn.removeClass('disabled');
				});
				value = real_count + '/' + value;
			} else {
				$comments_load_next_btn.animate({opacity: 0}, 500, function() {
					$comments_load_next_btn.addClass('disabled');
				});
			}

			$comments_counter.text(value);

			if(typeof callback == 'function') {
				callback();
			}
		};

		// Comments loader helper
		var updateComments = function() {
			$comments_load_next_btn.showSpinner();
			$comments_load_next_btn.addClass('disabled');

			var comments_request = API.request('GET', '/days/' + day.id + '/comments', {
				from: $comments_list.children().last().data('comment-id')
			});

			comments_request.success(function(response) {
				if(response.data.result.length > 0) {
					$comments_list.children('.template').remove();
				}

				$comments_load_next_btn.removeClass('disabled btn-danger');
				$comments_load_next_btn.hideSpinner();

				var new_comments = $($.trim(Template.compileElement(comments_template, {comments:response.data.result})));
				bindTooltips(new_comments);
				$comments_list.append(new_comments);

				setCommentsCounter(getCommentsCounter(), function() {
					$comments_list.children('.new').removeClass('new').fadeIn(500);
				});
			});

			comments_request.error(function() {
				$comments_load_next_btn.addClass('btn-danger').removeClass('disabled');
				$comments_load_next_btn.hideSpinner();
			});

			comments_request.send();
		};

		var $editor_form = $comments.find('form[name=add_comment_form]');
		var $editor_form_input = $comments.find('textarea');
		var $editor_form_submit_btn = $comments.find('button[type=submit]');

		// We store comment text for page-reload accidents
		var storage_key = "days/" + day.id + "/comment";

		// Getting saved data
		var saved_input = Storage.get(storage_key);
		if(saved_input && $editor_form_input.val() == '') {
			$editor_form_input.val(saved_input);
			$editor_form_submit_btn.removeClass('disabled').addClass('btn-success');
		}

		// Save comment text and activate/deactivate button
		$editor_form_input.on('keyup', function() {
			if($.trim($editor_form_input.val()) != '') {
				Storage.set(storage_key, $editor_form_input.val());
				$editor_form_submit_btn.removeClass('disabled btn-danger').addClass('btn-success');
			} else {
				Storage.remove(storage_key);
				$editor_form_submit_btn.removeClass('btn-success btn-danger').addClass('disabled');
			}
		});

		// Creating new comments
		$editor_form.submit(function() {
			if($editor_form_submit_btn.hasClass('disabled')) {
				return false;
			}

			$editor_form_input.prop("disabled", true);
			$editor_form_submit_btn.addClass('disabled');
			$editor_form_submit_btn.showSpinner();

			var comments_request = API.request('POST', '/days/' + day.id + '/comment', {
				text: $editor_form_input.val()
			});

			comments_request.success(function() {
				$editor_form_input.val('');
				$editor_form_submit_btn.hideSpinner();
				$editor_form_input.prop("disabled", false);
				updateComments();
				$editor_form_submit_btn.addClass('disabled').removeClass('btn-success btn-danger');
				Storage.remove(storage_key);
			});

			comments_request.error(function() {
				$editor_form_submit_btn.hideSpinner();
				$editor_form_input.prop("disabled", false);
				$editor_form_submit_btn.addClass('btn-danger').removeClass('btn-success disabled');
			});

			comments_request.send();

			return false;
		});

		// Comment deletion
		$comments_list.on('click', comment_delete_btn_selector, function() {
			var $article = $(this).closest('article[data-comment-id]');
			if(!$article.length) {
				console.error('Check comment id selector');
				return false;
			}
			var id = $article.data('comment-id');

			if(confirm("Do you really want to delete your comment?")) {
				var delete_request = API.request('POST', '/day_comments/' + id + '/delete');

				delete_request.success(function() {
					$article.fadeOut(500, function() {
						$article.remove();

						setCommentsCounter(getCommentsCounter()-1);
					});
				});

				delete_request.error(function() {
					alert("We can't delete comment right now, please try again later");
				}, true);

				delete_request.send();
			}
		});

		// Load new comments
		$comments_load_next_btn.click(function() {
			if($comments_load_next_btn.hasClass('disabled')) {
				return false;
			}

			updateComments();
		});

	})();

	// Likes
	(function() {
		var like_selector = '.like';
		var like_counter_selector = '.counter';
		var like_counter_state_selector = '.state';

		var like_active_class = 'liked';

		var current_user = API.getCurrentUser();

		function slideLikes($likes, length) {
			if(likes.is_liked) {
				$likes.addClass(like_active_class);
			} else {
				$likes.removeClass(like_active_class);
			}
			$likes.find(like_counter_selector).find(like_counter_state_selector).css("transform", "translateX(" + length + "px)");
		}

		likes.count = parseInt(likes.count, 10);

		var $likes = $(like_selector);

		$likes.each(function() {
			var $this = $(this);
			var $counter = $this.find(like_counter_selector);
			var $counter_count = $counter.find(like_counter_state_selector);
			var $counter_count_addon = $counter_count.clone();

			if(likes.is_liked) {
				$counter.prepend($counter_count_addon.text(likes.count-1));
			} else {
				$counter.append($counter_count_addon.text(likes.count+1));
			}

			var counters_width = Math.max($counter_count.width(), $counter_count_addon.width());
			var $states = $counter_count.add($counter_count_addon);
			$states.add($counter).width(counters_width);

			slideLikes($likes, likes.is_liked ?  -1*(counters_width+5) : 0);

			var title = '';
			if(current_user)
				title += '<a href="/pages/' + current_user.id + '/user" class="current-user"><img src="' + current_user.image_36 + '" /></a>';
			$.each(likes.recent, function(index, like) {
				if(like && (!current_user || like.user.id != current_user.id)) {
					title += '<a href="/pages/' + like.user.id + '/user"><img src="' + like.user.image_36 + '" /></a>';
				}
			});

			$this.tooltip({
				html: true,
				trigger: 'manual',
				placement: 'bottom',
				title: '<div class="likes">' + title + '</div>'
			});

			var timeout_id;

			var showLikes = function(event) {
				clearTimeout(timeout_id);
				if(!$this.next().hasClass('tooltip')) {
					$this.tooltip('show');
				}
			};

			var hideLikes = function() {
				timeout_id = setTimeout(function() {
					$this.tooltip('hide');
				}, 400);
			};

			var updateLikes = function() {
				likes.count = parseInt(likes.count, 10) + (likes.is_liked ? 1 : -1);
				slideLikes($likes, likes.is_liked ? -1*(counters_width+5) : 0);
				showLikes();
				if(likes.count < 1) {
					$this.tooltip('hide');
				}
			};

			$this.on('shown', function() {
				var $tooltip = $this.next().filter('.tooltip');
				if(!$this.hasClass('liked') && $tooltip.find('.likes').children().not('.current-user').length == 0) {
					$this.tooltip('hide');
					return;
				}
				$tooltip.hover(showLikes, hideLikes);
			});

			$this.hover(showLikes, hideLikes);
			$this.mousemove(showLikes);

      var likeSaveTimeout;

			$this.click(function() {
				if($this.hasClass('disabled')) {
					return;
				}
				var like_request = API.request('POST', '/days/' + day.id + '/' + (likes.is_liked == true ? 'unlike' : 'like'));
				like_request.error(function() {
  				alert("Can't save like information, try to reload page and try again");
        });

        clearTimeout(likeSaveTimeout);
        likeSaveTimeout = setTimeout(function() {
          like_request.send();
        }, 1000);

        likes.is_liked = !likes.is_liked;
        updateLikes();
			});
		});
	})();

  // Share
  (function() {
    var $share_btn = $day.find('.action-share');
    $share_btn.click(function () {
      if($share_btn.hasClass('disabled')) {
        return false;
      }
      $share_btn.addClass('disabled');

      var final_description_text = '';

      var $final_description = $day.find('.final-description');
      var $final_description_form = $final_description.find('form[name=final_description_form]');
      if ($final_description_form.length > 0) {
        final_description_text = $final_description_form.find('textarea[name=text]').val();
      } else {
        final_description_text = $final_description.text();
      }

      var params = {
        method: 'feed',
        link: window.location.href,
        name: $('meta[property="og:title"]').prop('content'),
        description: final_description_text,
        picture: $('meta[property="og:image"]').prop('content')
      };

      FB.ui(params, function(response) {
        if (!response || !response.post_id) {
          $share_btn.removeClass('disabled');
        }
      });
    });
  })();

	// Complain
	(function() {
		var $complain_btn = $day.find('.action-complain');

		$complain_btn.click(function() {
			if($complain_btn.hasClass('disabled')) {
				return false;
			}

			if(confirm("Do you really want to send complain?")) {
				$complain_btn.addClass('disabled');

				var message = prompt("Why do you think this day should be deleted?");

				var complain_request = API.request('POST', '/days/' + day.id + '/complain', {
					text: message
				});

				complain_request.success(function() {
					$complain_btn.html('<i class="icon-warning-sign"></i> Complained');
				});

				complain_request.send();
			}
		});
	})();

  // Scroll helpers
  (function() {
    var $scrollContainer = $(document);
    var $scrollHelper = $('.scrollHelper');
    var helperHeight = $scrollHelper.height();
    var helperDefaultOffset = -1*helperHeight;

    function setBottomOffset(offset) {
      var sign = offset ? offset < 0 ? -1 : 1 : 0;

      $scrollHelper.css('bottom', sign + offset + 'px');
    }

    setBottomOffset(helperDefaultOffset);

    $scrollContainer.on('scroll.scrollHelper touchmove.scrollHelper', function() {
      var scrollTop = $scrollContainer.scrollTop();

      if(scrollTop > 500) {
        var diff = scrollTop - 500;
        if(diff < helperHeight && !$.isMobile()) {
          var shift = diff - helperHeight;
          setBottomOffset(shift > helperDefaultOffset ? shift : helperDefaultOffset);
        } else {
          setBottomOffset(0);
        }
      } else {
        setBottomOffset(helperDefaultOffset);
      }
    });

    $(document).on('click', '.scrollTo.comments', function(event) {
      $(document).scrollTo($('a[name=comments]'), 1000);
      return false;
    });

    $(document).on('click', '.scrollTo.top', function() {
      $(document).scrollTo(0, 1000);
      return false;
    });

    $(document).on('click', '.scrollTo.moment', function() {
      var $this = $(this);

      $(document).scrollTo($('.moments article[data-moment-id=' + $this.data('moment-id') + ']'), 0, {
        onAfter: function() {
    			document.location.hash = 'moment-id'+$this.data('moment-id');
        }
      });
      return false;
    });
  })();
});
