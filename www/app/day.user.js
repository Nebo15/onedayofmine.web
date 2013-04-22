$(function() {
  "use strict";

  // Day cointainer
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

      var comments_request = API.request('GET', '/days/' + day_data.id + '/comments', {
        from: $comments_list.children().last().data('comment-id')
      });

      comments_request.success(function(response) {
        $comments_load_next_btn.removeClass('disabled btn-danger');
        $comments_load_next_btn.hideSpinner();

        var new_comments = $($.trim(Template.compileElement(comments_template, {comments:response.data.result})));
        bindTooltips(new_comments);
        $comments_list.append(new_comments);

        setCommentsCounter(getCommentsCounter(), function() {
          $comments_list.children('.new').removeClass('new').fadeIn();
        });
      });

      comments_request.error(function() {
        $comments_load_next_btn.addClass('btn-danger').removeClass('disabled');
        $comments_load_next_btn.hideSpinner();
      });

      comments_request.send();
    };

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

    // Autoload new comments
    /*setTimeInterval(function() {
      if($comments_load_next_btn.hasClass('disabled')) {
        return false;
      }

      updateComments();
    }, 10000);*/

    // Editor
    (function() {
      var $editor_form = $comments.find('form[name=add_comment_form]');
      var $editor_form_input = $comments.find('textarea');
      var $editor_form_submit_btn = $comments.find('button[type=submit]');

      // We store comment text for page-reload accidents
      var storage_key = "days/" + day_data.id + "/comment";

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

        var comments_request = API.request('POST', '/days/' + day_data.id + '/comment', {
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
    })();
  })();

  // Likes
  (function() {
    // Like toggle
    if(day_data.is_liked === undefined) {
      return false;
    }

    var $like_btn = $day.find('.action-like');
    var $like_btn_addon = $like_btn.prev();

    // Helper for likes counters
    function updateLikesBtn() {
      var icon = day_data.is_liked ? '<i class="icon-heart"></i>' : '<i class="icon-heart-empty"></i>';
      $like_btn_addon.html(icon + ' ' + day_data.likes_count);

      $like_btn.html(day_data.is_liked ? 'Unlike' : 'Like');
    }

    $like_btn.click(function() {
      if($like_btn.hasClass('disabled')) {
        return false;
      }
      $like_btn.addClass('disabled');

      var current_user = API.getCurrentUser();

      if(day_data.is_liked) {
        var unlike_request = API.request('POST', '/days/' + day_data.id + '/unlike');
        unlike_request.success(function() {
          day_data.is_liked = false;
          day_data.likes_count--;

          $.each(day_data.likes, function(index, like) {
            if(like && like.user.id == current_user.id) {
              delete day_data.likes[index];
            }
          });

          updateLikesBtn();
          $like_btn.removeClass('disabled');
        });
        unlike_request.send();
      } else {
        var like_request = API.request('POST', '/days/' + day_data.id + '/like');
        like_request.success(function() {
          day_data.is_liked = true;
          day_data.likes_count++;

          day_data.likes.push({
            id: 0,
            user: current_user
          });

          updateLikesBtn();
          $like_btn.removeClass('disabled');
        });
        like_request.send();
      }
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

        var complain_request = API.request('POST', '/days/' + day_data.id + '/complain', {
          text: message
        });

        complain_request.success(function() {
          $complain_btn.html('<i class="icon-warning-sign"></i> Complained');
        });

        complain_request.send();
      }
    });
  })();
});
