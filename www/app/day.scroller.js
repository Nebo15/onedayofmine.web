(function($) {
  // TODO connected lists
  var Sortable = function($elem, options) {
    var $self = this;
    var $items,
        $placeholder;

    var options = $.extend({
      item: 'li',
      handle: false
    }, options);

    this.enable = function() {
      var $items = $elem.children(options.item);
      var items_tag_name = $items.get(0) ? $items.get(0).tagName : 'div';
      var $placeholder = $($.parseHTML('<' + items_tag_name + ' class="sortable-placeholder"></' + items_tag_name + '>'));

      var handleActive = false,
          dragging_initial_index,
          $dragging = false;

      $items.attr('draggable', true);

      $elem.on('mousedown.sortable', options.handle, function() {
        handleActive = true;
      })

      $elem.on('mouseup.sortable', options.handle, function() {
        handleActive = false;
      });

      $elem.on('dragstart.sortable', options.item, function(event) {
        if(options.handle && !handleActive) {
          return false;
        }

        event.originalEvent.dataTransfer.effectAllowed = 'move';
        event.originalEvent.dataTransfer.setData('Text', "Drop element on it's new position"); // Hi, IE9

        handleActive = false;
        $dragging = $(this).addClass('sortable-dragging');
        dragging_initial_index = $dragging.index();

        $placeholder.height($dragging.outerHeight());

        $elem.trigger('sortstart', {item: $dragging});
        if(typeof options.onSortStart === 'function') {
          options.onSortStart($dragging);
        }
      });

      $elem.on('dragend.sortable drop.sortable', options.item, function(event) {
        if(!$dragging) {
          return;
        }

        event.stopPropagation();
        event.preventDefault();

        $dragging.insertAfter($placeholder);
        $dragging.removeClass('sortable-dragging');
        $dragging.show();
        $placeholder.detach();
        if(dragging_initial_index != $dragging.index()) {
          $elem.trigger('sortupdate', {item: $dragging});
          if(typeof options.onSortUpdate === 'function') {
            options.onSortUpdate($dragging);
          }
        }

        $elem.trigger('sortend', {item: $dragging});
        if(typeof options.onSortEnd === 'function') {
          options.onSortEnd($dragging);
        }

        $dragging = null;

        return false;
      });

      $elem.on('dragover.sortable dragenter.sortable', options.item, function(event) {
        if(!$dragging) {
          return true;
        }

        event.originalEvent.dataTransfer.dropEffect = 'move';

        var $this = $(this);
        if($items.is($this)) {
          $dragging.hide();
          $this[$placeholder.index() < $this.index() ? 'after' : 'before']($placeholder);
        }
      });

      $elem.on('selectstart.sortable', '*', function(event) {
        event.preventDefault();
      })
    };

    this.disable = function() {
      $elem.off('.sortable');
      $elem.children(options.item).attr('draggable', false);
    };

    this.reload = function() {
      $self.disable();
      $self.enable();
    };

    this.destroy = function() {
      $self.disable();
      $elem.removeData('sortable-api');
    };

    // Init
    this.enable();
  };

  $.fn.sortable = function(options) {
    return this.each(function() {
      var $this = $(this);
      var api = $this.data('sortable-api');

      if(typeof options === 'string') {
        if(!api) {
          console.error('Sortable methods called before init');
          return;
        }

        api[options]();
      } else {
        if(!api) {
          api = new Sortable($this, options);
          $this.data('sortable-api', api);
        } else {
          console.error('Sortable is already initalized');
        }
      }
    });
  };
})(jQuery);

$(window).load(function() {
  // Inject scroller
  var scroller_template = Template.prepareTemplate($('#template_scroller'));
  var scroller_preview_template = Template.prepareTemplate($('#template_scroller_preview'));
  $('article.day').append(Template.compileElement(scroller_template, {
    moments: []
  }));

  // Permanent selectors
  var $scroller = $('.day').find('.scroller');
  var $scroller_viewport = $scroller.find('.viewport');
  var $scroller_scroll_zone = $scroller.find('.scroll_zone');
  var $scroller_previews = $scroller.find('.previews');
  var $moments = $('.day').find('.moments');

  // Permanent values
  var window_width = $(window).width();
  var window_height = $(window).height();

  var viewport_height = $scroller_viewport.height();
  var viewport_margin_top = parseInt($scroller_viewport.css('margin-top'), 10);
  var viewport_margin_bottom = parseInt($scroller_viewport.css('margin-bottom'), 10);
  var scroll_zone_offset_top = parseInt($scroller_scroll_zone.css('top'), 10);
  var scroll_zone_offset_bottom = parseInt($scroller_scroll_zone.css('bottom'), 10);
  var scroll_zone_height = $scroller_scroll_zone.outerHeight();

  var scroller_active = false;

  // Selectors that can be changed
  var $moments_articles,
      $moments_articles_first,
      $moments_articles_last;

  // Values that can be changed
  var previews_height,
      moments_from,
      moments_to,
      scroller_scale_ratio,
      scroll_zone_animated;

  // Fix scroller viewport ratio
  var moment_height = 760;
  var moment_preview_height = 74;
  function fixViewportHeight() {
    if($moments_articles_first) {
      moment_height = $moments_articles_first.height();
      moment_preview_height = $scroller_previews.find('li').first().height();
    }

    $scroller_viewport.height(moment_preview_height * window_height / moment_height);
    viewport_height = $scroller_viewport.height();
  };

  $(window).resize(function() {
    window_width = $(window).width();
    window_height = $(window).height();

    fixViewportHeight();
  });
  fixViewportHeight();

  function moveViewport(offset) {
    var scroll_zone_end = scroll_zone_height + scroll_zone_offset_top - viewport_margin_top + scroll_zone_offset_bottom - viewport_margin_bottom;
    var shift = 0;

    if(scroll_zone_animated) {
      var scroll_zone_center = (scroll_zone_height + scroll_zone_offset_top + scroll_zone_offset_bottom) / 2;
      var viewport_center = offset + viewport_height / 2 + viewport_margin_top;
      var offset_center = scroll_zone_height / 2 - viewport_height / 2 + scroll_zone_offset_top - viewport_margin_top;
      var max_shift = previews_height - scroll_zone_height;

      if(viewport_center > scroll_zone_center) {
        shift = offset - offset_center;
        offset = offset_center;

        // Don't show empty space under previews
        if(shift > max_shift) {
          offset += shift - max_shift;
          shift = max_shift;
        }
      }
    }

    // Limit viewport min offset to dont go out of scroll_zone
    if(offset < 0) {
      offset = 0;
    }

    // Limit viewport max offset to dont go out of scroll_zone
    if(offset + viewport_height > scroll_zone_end) {
      offset = scroll_zone_end - viewport_height;
    }

    // Limit viewport max offset to dont go out of previews zone
    if(offset + viewport_height > previews_height) {
      offset = previews_height - viewport_height;
    }

    $scroller_previews.css('top', (-1 * shift) + 'px');
    $scroller_viewport.css('top', offset + 'px');
  }

  function updateScroller() {
    // Selectors
    $moments_articles = $moments.children('article');
    $moments_articles_first = $moments_articles.first();
    $moments_articles_last = $moments_articles.last();

    // Redraw moments previews list
    $scroller_previews.html('');
    $moments_articles.each(function() {
      var $moment = $(this);
      var preview = $($.parseHTML(Template.compileElement(scroller_preview_template, {
        id: $moment.data('moment-id'),
        image_532: $moment.find('.image img').attr('src')
      })));
      preview.data('moment-attached', $moment);
      $scroller_previews.append(preview);
    });
    $scroller_previews.sortable('reload');

    // Calculations
    previews_height = $scroller_previews.height();
    moments_from = $moments_articles_first.offset().top;
    moments_to = $moments_articles_last.offset().top + $moments_articles_last.height();
    scroller_scale_ratio = (moments_to - moments_from) / previews_height;

    // Do we need to move scroll_zone due to too big previews_height?
    scroll_zone_animated = window_height - viewport_margin_top - viewport_margin_bottom < previews_height ? 1 : 0;

    // Show scroller
    if(!scroller_active) {
      scroller_active = true;

      $(document).on('scroll.scroller touchmove.scroller', function() {
        var offsetTop = $(this).scrollTop();
        var offsetMoments = offsetTop > moments_from ? offsetTop - moments_from : 0;

        moveViewport(offsetMoments / scroller_scale_ratio);
      });

      // $scroller.imagesLoaded(function() {
        setTimeout(function() {
          $scroller.css('right', 0);
        }, 1000);
      // });
    }
  }

  if(day_data.user.id == API.getCurrentUser().id) {
    // Allow sorting
    $scroller_previews.sortable({
      handle: 'img'
    });

    $scroller_previews.on('sortupdate', function(event, moved) {
      var $item = $(moved.item);
      var $moment = $item.data('moment-attached');
      var moment_position = $item.prevAll().length;
      var position_request = API.request('POST', '/moments/' + $moment.data('moment-id') + '/update', {
        position: moment_position
      })

      position_request.success(function() {
        $moments.trigger('sortupdate', {moment: $moment, position: moment_position})
      });

      position_request.send();
    });
  }

  if(day_data.moments.length > 0) {
    updateScroller();
  }

  $moments.on('momentschanged', function(event, changes) {
    updateScroller(changes.moment);
  });
});
