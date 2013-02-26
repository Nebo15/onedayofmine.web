$(function() {
  // Share toggle
  var share_button = $('button#toggle_share');
  share_button.click(function() {
    if(!share_button.hasClass('disabled')) {
      share_button.addClass('disabled');

      var description = $('.final-description');
      if(description.find('textarea').length > 0) {
        description = description.find('textarea').text();
      } else {
        description = description.text();
      }

      var title = $('.day-title').text();

      var obj = {
          method: 'feed',
          redirect_uri: 'http://'+Config.host+'/pages/{$#day->id}/day',
          link: 'http://'+Config.host+'/pages/{$#day->id}/day',
          name: title,
          description: description
      };

      FB.ui(obj, function() {
        share_button.addClass('btn-success');
      });
    }
  });

  // Mobile nav comments
  $('.mobile-nav #comments').click(function() {
    $(document).scrollTo($('.comments'), 400);
  });
});
