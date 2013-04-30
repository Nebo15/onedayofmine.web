$(function () {
  "use strict";

  // Main container
  var $journal = $('.journal');

  var animations_speed = 400;

  function findDayByContext(context) {
    return $(context).closest('.day');
  }

  // Expand
  (function() {
    var moments_template = Template.prepareTemplate($('#template_moments'));

    $journal.one('click', '.action-expand', function() {
      return true; // Redirect to page

      var $btn = $(this);
      if($btn.hasClass('disabled')) {
        return false;
      }
      $btn.addClass('disabled');
      $btn.showSpinner();

      var $day = findDayByContext(this);
      var $moments = $day.find('.moments');

      var day_request = API.request('GET', '/days/' + $day.data('id'));

      day_request.success(function(response) {
        var day_data = response.data.result;
        var moments = day_data.moments;

        $.each(moments, function(index, moment) {
          var moment_datatime = new Date(moment.time);
          moment.time = moment_datatime.getHours() + ':' + moment_datatime.getMinutes();
        });

        var $loaded_moments = $($.parseHTML(Template.compileElement(moments_template, {
          moments: moments
        }))).filter('article');

        $moments.append($loaded_moments);
        $loaded_moments.imagesLoaded(function() {
          var total_height = 0;
          $loaded_moments.each(function() {
            var current = $(this);
            total_height += $(this).outerHeight(true);
          });

          $moments.animate({
            height: total_height
          }, Math.max(total_height/10000, animations_speed));

          $day.find('.cover').find('.image').slideUp(animations_speed, function() {
            $day.addClass('expanded');
            $btn.hideSpinner();
            $btn.removeClass('disabled');
            $btn.html("Go to this day &rarr;");
          });
        });
      });

      day_request.error(function() {
        window.location.href = $btn.attr('href');
      });

      day_request.send();

      return false;
    });
  })();

  // Share
  (function() {
    $journal.on('click', '.action-share', function() {
      var $share_btn = $(this);
      if($share_btn.hasClass('disabled')) {
        return false;
      }
      $share_btn.addClass('disabled');

      var $day = findDayByContext(this);

      var params = {
        method: 'feed',
        link: window.location.protocol + "//" + window.location.host + "/pages/" + $day.data('id') + "/day",
        name: $day.find('.final-description').text(),
        description: $day.find('.title').text(),
        picture: $day.data('cover-image')
      };

      FB.ui(params, function(response) {
        if (!response || !response.post_id) {
          $share_btn.removeClass('disabled');
        }
      });
    });
  })();

  // Likes
  (function() {
    // var like_selector = '.like';
    // var like_counter_selector = '.counter';
    // var like_counter_state_selector = '.state';

    // var like_active_class = 'liked';

    // var current_user = API.getCurrentUser();

    // function slideLikes($likes, length) {
    //   if(day_data.is_liked) {
    //     $likes.addClass(like_active_class);
    //   } else {
    //     $likes.removeClass(like_active_class);
    //   }
    //   $likes.find(like_counter_selector).find(like_counter_state_selector).css("transform", "translateX(" + length + "px)");
    // }

    // day_data.likes_count = parseInt(day_data.likes_count, 10);

    // var $likes = $(like_selector);

    // $likes.each(function() {
    //   var $this = $(this);
    //   var $counter = $this.find(like_counter_selector);
    //   var $counter_count = $counter.find(like_counter_state_selector);
    //   var $counter_count_addon = $counter_count.clone();

    //   if(day_data.is_liked) {
    //     $counter.prepend($counter_count_addon.text(day_data.likes_count-1));
    //   } else {
    //     $counter.append($counter_count_addon.text(day_data.likes_count+1));
    //   }

    //   var counters_width = Math.max($counter_count.width(), $counter_count_addon.width());
    //   var $states = $counter_count.add($counter_count_addon);
    //   $states.add($counter).width(counters_width);

    //   slideLikes($likes, day_data.is_liked ?  -1*(counters_width+5) : 0);

    //   var title = '<a href="/pages/' + current_user.id + '/user" class="current-user"><img src="' + current_user.image_36 + '" /></a>';
    //   $.each(day_data.likes, function(index, like) {
    //     if(like && like.user.id != current_user.id) {
    //       title += '<a href="/pages/' + like.user.id + '/user"><img src="' + like.user.image_36 + '" /></a>';
    //     }
    //   });

    //   $this.tooltip({
    //     html: true,
    //     trigger: 'manual',
    //     placement: 'bottom',
    //     title: '<div class="likes">' + title + '</div>'
    //   });

    //   var timeout_id;

    //   var showLikes = function(event) {
    //     clearTimeout(timeout_id);
    //     if(!$this.next().hasClass('tooltip')) {
    //       $this.tooltip('show');
    //     }
    //   };

    //   var hideLikes = function() {
    //     timeout_id = setTimeout(function() {
    //       $this.tooltip('hide');
    //     }, 400);
    //   };

    //   var updateLikes = function() {
    //     day_data.likes_count = parseInt(day_data.likes_count, 10) + (day_data.is_liked ? 1 : -1);
    //     slideLikes($likes, day_data.is_liked ? -1*(counters_width+5) : 0);
    //     showLikes();
    //     if(day_data.likes_count < 1) {
    //       $this.tooltip('hide');
    //     }
    //   };

    //   $this.on('shown', function() {
    //     var $tooltip = $this.next().filter('.tooltip');
    //     if(!$this.hasClass('liked') && $tooltip.find('.likes').children().not('.current-user').length == 0) {
    //       $this.tooltip('hide');
    //       return;
    //     }
    //     $tooltip.hover(showLikes, hideLikes);
    //   });

    //   $this.hover(showLikes, hideLikes);
    //   $this.mousemove(showLikes);

    //   if(day_data.is_liked === undefined) {
    //     return false;
    //   }

    //   $this.click(function() {
    //     if($this.hasClass('disabled')) {
    //       return;
    //     }

    //     day_data.is_liked = !day_data.is_liked;
    //     updateLikes();

    //     var like_request = API.request('POST', '/days/' + day_data.id + '/' + (day_data.is_liked ? 'like' : 'unlike'));

    //     like_request.error(function() {
    //       alert("Can't submit like state, try to reload the page");
    //     });

    //     like_request.send();
    //   });
    // });
  })();
});
