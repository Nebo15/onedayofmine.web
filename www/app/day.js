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

  // Scroll helpers
  (function() {
    var scrollContainer = $(document);
    var scrollHelper = $('.scrollHelper');
    var helperHeight = scrollHelper.height();
    var helperDefaultOffset = -1*helperHeight;

    function setBottomOffset(offset) {
      var sign = offset ? offset < 0 ? -1 : 1 : 0;

      scrollHelper.css('bottom', sign + offset + 'px');
    }

    setBottomOffset(helperDefaultOffset);

    scrollContainer.scroll(function() {
      var scrollTop = scrollContainer.scrollTop();

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

    $('.scrollTo.comments').click(function() {
      $(document).scrollTo($('a[name=comments]'), 200);
    });

    $('.scrollTo.top').click(function() {
      $(document).scrollTo(0, 200);
    });
  })();
});
