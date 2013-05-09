$(window).load(function() {
  // Inject scroller
  var scroller_template = Template.prepareTemplate($('#template_scroller'));
  $('article.day').append(Template.compileElement(scroller_template, {
    moments: day_data.moments
  }));

  // Selectors
  var $scroller = $('.day').find('.scroller');
  var $scroller_viewport = $scroller.find('.viewport');
  var $scroller_scroll_zone = $scroller.find('.scroll_zone');
  var $scroller_previews = $scroller.find('.previews');

  var $moments = $('.day').find('.moments');
  var $moments_articles = $moments.children('article');

  var $moments_articles_first = $moments_articles.first();
  var $moments_articles_last = $moments_articles.last();

  // Show scroller
  setTimeout(function() {
    $scroller.css('right', 0);
  }, 1000);

  if(day_data.user.id == API.getCurrentUser().id) {
    // Allow sorting
    $scroller_previews.sortable();

    $scroller_previews.on('sortupdate', function(event, moved) {
      var $item = $(moved.item);
      API.request('POST', '/moments/' + $item.data('moment-id') + '/update', {
        position: $item.prevAll().length
      }).send();
    });
  }

  // Precalculate some values
  var window_width = $(window).width();
  var window_height = $(window).height();

  var viewport_height = $scroller_viewport.height();
  var viewport_margin_top = parseInt($scroller_viewport.css('margin-top'), 10);
  var viewport_margin_bottom = parseInt($scroller_viewport.css('margin-bottom'), 10);
  var scroll_zone_margin_top = parseInt($scroller_scroll_zone.css('top'), 10);
  var scroll_zone_margin_bottom = parseInt($scroller_scroll_zone.css('bottom'), 10);
  var scroll_zone_height = $scroller_scroll_zone.height();
  var previews_height = $scroller_scroll_zone[0].scrollHeight;

  var moments_from = $moments_articles_first.offset().top;
  var moments_to = $moments_articles_last.offset().top + $moments_articles_last.height();

  var scroller_scale_ratio = ($moments.height() - moments_from) / previews_height;

  function moveViewport(offset) {
    if(offset + viewport_height / 2 + scroll_zone_margin_top >= window_height / 2) {
      var tmp = offset;
      offset = window_height / 2 - viewport_height / 2 - viewport_margin_top;

      if(tmp >= previews_height - window_height / 2 - viewport_height / 2 + scroll_zone_margin_top) {
        offset = tmp - (previews_height - window_height + viewport_height / 2) - 13; // Magic number here, warning!

        if(offset > window_height - viewport_height - viewport_margin_top - viewport_margin_bottom) {
          offset = window_height - viewport_height - viewport_margin_top - viewport_margin_bottom;
        }

        $scroller_previews.css('top', (scroll_zone_height - previews_height) + 'px');
      } else {
        $scroller_previews.css('top', (offset - tmp) + 'px');
      }
    } else {
      if(offset < 0) {
        offset = 0;
      }

      $scroller_previews.css('top', 0);
    }

    $scroller_viewport.css('top', offset + 'px');
  }

  // Fix scroller viewport ratio
  // $scroller_viewport.height($scroller_viewport.width() / (window_width / window_height));

  $(document).on('scroll touchmove', function() {
    var scrollTop = $(this).scrollTop();

    moveViewport((scrollTop - moments_from) / scroller_scale_ratio);
  });
});
