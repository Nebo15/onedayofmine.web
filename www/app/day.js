$(function () {
	// Share toggle
	var fb_share_button = $('button#toggle_fb_share');
	fb_share_button.click(function () {
    if(fb_share_button.hasClass('disabled')) {
      return;
    }
    fb_share_button.addClass('disabled');

		var description = $('.final-description');
		if (description.find('textarea').length > 0) {
			description = description.find('textarea').text();
		} else {
			description = description.text();
		}

		var obj = {
			method: 'feed',
			link: window.location.href,
			name: $('meta[property="og:title"]').prop('content'),
			description: description,
			picture: $('meta[property="og:image"]').prop('content')
		};

		FB.ui(obj, function(response) {
      if (!response || !response.post_id) {
        fb_share_button.removeClass('disabled');
      }
    });
	});

	// Mobile nav comments
	$('.mobile-nav #comments').click(function () {
		$(document).scrollTo($('.comments'), 400);
	});
});
