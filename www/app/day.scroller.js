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
      var $placeholder = $($.parseHTML('<' + $items.get(0).tagName + ' class="sortable-placeholder"></' + $items.get(0).tagName + '>'));

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
        event.originalEvent.dataTransfer.setData('Text', "Drop element on it's new position");

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
    $scroller_previews.sortable({
      handle: 'img'
    });

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
  var previews_height = $scroller_previews.height();

  var moments_from = $moments_articles_first.offset().top;
  var moments_to = $moments_articles_last.offset().top + $moments_articles_last.height();

  var scroller_scale_ratio = $moments.outerHeight() / previews_height;

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

          $scroller_previews.css('top', (scroll_zone_height - previews_height) + 'px');
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

  // Fix scroller viewport ratio
  // $scroller_viewport.height($scroller_viewport.width() / (window_width / window_height));

  $(document).on('scroll touchmove', function() {
    var scrollTop = $(this).scrollTop();

    moveViewport((scrollTop - moments_from) / scroller_scale_ratio);
  });
});
