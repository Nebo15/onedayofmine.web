$(function () {
  "use strict";

  // Main container
  var $day = $('.day');

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

    if($.isMobile()) {
      setBottomOffset(0);
    } else {
      $scrollContainer.scroll(function() {
        var scrollTop = $scrollContainer.scrollTop();

        if(scrollTop > 500) {
          var diff = scrollTop - 500;
          if(diff < helperHeight) {
            var shift = diff - helperHeight;
            setBottomOffset(shift > helperDefaultOffset ? shift : helperDefaultOffset);
          } else {
            setBottomOffset(0);
          }
        } else {
          setBottomOffset(helperDefaultOffset);
        }
      });
    }

    $('.scrollTo.comments').click(function() {
      $(document).scrollTo($('a[name=comments]'), 200);
    });

    $('.scrollTo.top').click(function() {
      $(document).scrollTo(0, 200);
    });
  })();
});
