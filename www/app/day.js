$(function () {
	// Share toggle
	var share_button = $('button#toggle_share');
	share_button.click(function () {
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

		FB.ui(obj, function () {
			share_button.addClass('btn-success');
		});
	});

	// Mobile nav comments
	$('.mobile-nav #comments').click(function () {
		$(document).scrollTo($('.comments'), 400);
	});
});
