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
    $(document).on('click', '.scrollTo.comments', function(event) {
      $(document).scrollTo($('a[name=comments]'), 1000);
      return false;
    });

    $(document).on('click', '.scrollTo.top', function() {
      $(document).scrollTo(0, 1000);
      return false;
    });

    $(document).on('click', '.scrollTo.moment', function() {
      $(document).scrollTo($('.moments article[data-moment-id=' + $(this).data('moment-id') + ']'), 1000);
      return false;
    });
  })();
});
