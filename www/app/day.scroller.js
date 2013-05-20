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
  var scroll_zone_margin_top = parseInt($scroller_scroll_zone.css('top'), 10);
  var scroll_zone_margin_bottom = parseInt($scroller_scroll_zone.css('bottom'), 10);
  var scroll_zone_height = $scroller_scroll_zone.height();

  var scroller_active = false;

  // Selectors that can be changed
  var $moments_articles,
      $moments_articles_first,
      $moments_articles_last;

  // Values that can be changed
  var previews_height,
      moments_from,
      moments_to,
      scroller_scale_ratio;

  function moveViewport(offset) {
    if(offset + viewport_height / 2 + scroll_zone_margin_top >= window_height / 2) {
      var tmp = offset;
      offset = window_height / 2 - viewport_height / 2 - viewport_margin_top;

      if(tmp >= previews_height - window_height / 2 - viewport_height / 2 + scroll_zone_margin_top) {
        if(offset > previews_height - viewport_height) {
          offset = previews_height - viewport_height;
        } else {
          offset = tmp - (previews_height - window_height + viewport_height / 2) - 13; // Magic number here, warning!

          if(offset > window_height - viewport_height - viewport_margin_top - viewport_margin_bottom) {
            offset = window_height - viewport_height - viewport_margin_top - viewport_margin_bottom;
          }

          if(scroll_zone_height > previews_height) {
            $scroller_previews.css('top', 0);
          } else {
            $scroller_previews.css('top', (scroll_zone_height - previews_height) + 'px');
          }
        }
      } else {
        $scroller_previews.css('top', (offset - tmp) + 'px');
      }
    } else {
      if(offset < 0) {
        offset = 0;
      }

      $scroller_previews.css('top', 0);
    }

    if(offset > previews_height - viewport_height) {
      offset = previews_height - viewport_height;
    }

    $scroller_viewport.css('top', offset + 'px');
  }

  $scroller_previews.on('click', 'li', function() {
    console.log($(this).data('moment-attached'));
  })

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
    scroller_scale_ratio = $moments.outerHeight() / previews_height;

    // Fix scroller viewport ratio
    // $scroller_viewport.height($scroller_viewport.width() / (window_width / window_height));

    // Show scroller
    if(!scroller_active) {
      scroller_active = true;

      $(document).on('scroll.scroller touchmove.scroller', function() {
        moveViewport(($(this).scrollTop() - moments_from) / scroller_scale_ratio);
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
