$(function() {
  // Comments
  (function() {
    // Comments updater
    var comments = $('.comments');
    var comments_input  = comments.find('textarea');
    var comments_button = comments.find('button[type=submit]');
    var comments_delete_button_selector = '.btn-comment-delete';
    var comments_delete_button = comments.find(comments_delete_button_selector);
    var comments_counter = comments.find('#comments_counter');

    var comments_loader = $('.comments-loader');
    var comments_loader_button = comments_loader.find('button[type=button]');
    var comments_template = Template.prepareTemplate($('#template_comments'));

    var comment_storage_key = "days/"+day_data.id+"/comment";

    var comment_saved_input = Storage.get(comment_storage_key);
    if(comments_input.val() == '' && comment_saved_input !== undefined && comment_saved_input) {
      comments_input.val(comment_saved_input);
      comments_button.removeClass('disabled').addClass('btn-success');
    }

    var getCommentsCounter = function() {
      var text = comments_counter.text();
      return parseInt(text.substring(text.indexOf('/')+1), 10);
    };

    var setCommentsCounter = function(value, callback) {
      var real_count = $('.comment-item').length;

      if(value < real_count) {
        value = real_count;
        if(typeof callback == 'function') {
          callback();
        }
      } else if(value > real_count) {
        if(comments_loader_button.css('display') == 'none') {
          comments_loader_button.fadeIn(500);
        }
        value = real_count + '/' + value;
        if(typeof callback == 'function') {
          callback();
        }
      } else if(value > 3 && comments_loader_button.css('display') == 'none') {
        comments_loader_button.fadeIn(500, callback);
      } else {
        comments_loader_button.fadeOut(500, callback);
      }

      comments_counter.text(value);
    };

    var deleteComment = function() {
      var element = $(this).closest('[comment_id]');
      var id = element.attr('comment_id');

      if(confirm("Do you really want to delete your comment?")) {
        var delete_request = API.request('POST', '/day_comments/' + id + '/delete');
        delete_request.success(function() {
          element.fadeOut(500, function() {
            element.remove();

            setCommentsCounter(getCommentsCounter()-1);
          });
        });

        delete_request.error(function() {
          alert("We can't delete right now, please try again later or tell us about this issue");
        }, true);

        delete_request.send();
      }
    };

    var updateComments = function() {
      if(!comments_loader_button.hasClass('disabled')) {
        var comments_request = API.request('GET', '/days/'+day_data.id+'/comments', {
          from: comments.find('li[comment_id]').last().attr('comment_id')
        });

        comments_loader_button.showSpinner();
        comments_loader_button.addClass('disabled');

        comments_request.success(function(response) {
          comments_loader_button.removeClass('disabled btn-danger');
          comments_loader_button.hideSpinner();

          var tmp = $($.trim(Template.compileElement(comments_template, {comments:response.data.result})));

          tmp.find(comments_delete_button_selector).click(deleteComment);

          bindTooltips(tmp);
          comments_loader.before(tmp);

          setCommentsCounter(getCommentsCounter(), function() {
            $('.comment-item').fadeIn();
          });
        });

        comments_request.error(function() {
          comments_loader_button.addClass('btn-danger');
          comments_loader_button.hideSpinner();
        });

        comments_request.send();
      }
    };

    comments_loader_button.click(updateComments);

    // Comments
    comments_input.on('keyup', function(event) {
      if($.trim(comments_input.val()) != '') {
        comments_button.removeClass('disabled btn-danger').addClass('btn-success');
        Storage.set(comment_storage_key, comments_input.val());
      } else {
        comments_button.addClass('disabled').removeClass('btn-success btn-danger');
        Storage.remove(comment_storage_key);
      }
    });

    comments_button.click(function() {
      if(!comments_button.hasClass('disabled')) {
        comments_input.prop("disabled", true);
        comments_button.addClass('disabled');
        comments_button.showSpinner();

        var comments_request = API.request('POST', '/days/'+day_data.id+'/comment', {
          text: comments_input.val()
        });

        comments_request.success(function() {
          comments_input.val('');
          comments_input.prop("disabled", false);
          comments_button.hideSpinner();
          updateComments();
          comments_button.addClass('disabled').removeClass('btn-success');
          Storage.remove(comment_storage_key);
        });

        comments_request.error(function() {
          comments_button.hideSpinner();
          comments_button.addClass('btn-danger').removeClass('btn-success');
        });

        comments_request.send();
      }
    });

    comments_delete_button.click(deleteComment);
  })();

  // Likes
  (function() {
    // Like toggle
    if(day_data.is_liked !== undefined) {
      var likes_count = day_data.likes_count;

      var like_button = $('button#toggle_like');
      like_button.click(function() {
        if(!like_button.hasClass('disabled')) {
          like_button.addClass('disabled');

          var like_request;
          if(day_data.is_liked == true) {
            like_request = API.request('POST', '/days/'+day_data.id+'/unlike');
            like_request.success(function() {
              day_data.is_liked = false;
              likes_count--;

              like_button.text('Like');
              $('#toggle_like_icon').html('<i class="icon icon-heart-empty"></i> ' + likes_count);
              like_button.removeClass('disabled');
            });
          } else {
            like_request = API.request('POST', '/days/'+day_data.id+'/like');
            like_request.success(function() {
              day_data.is_liked = true;
              likes_count++;

              like_button.text('Unlike');
              $('#toggle_like_icon').html('<i class="icon icon-heart"></i> ' + likes_count);
              like_button.removeClass('disabled');
            });
          }
          like_request.send();
        }
      });
    }
  })();
});
