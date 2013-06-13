(function($) {
  "use strict";

  var Obj = function(element, params) {
    this.$element = $(element);
    params = params || {};

    if(params.defaultHeight && params.defaultHeight == 'min') {
      params.defaultHeight = params.minHeight ? params.minHeight : this.$element.height();
    }

    var maxHeight = parseInt(this.$element.css('max-height'), 10);

    this.params = $.extend(true, {
      minHeight: this.$element.height(),
      maxHeight: isNaN(maxHeight) ? false : maxHeight,
      defaultHeight: false,
      onResize: $.noop
    }, params);

    this.init();
  };

  Obj.prototype = {
    init: function() {
      var $self = this;
      var $element = $self.$element;
      var element = $element.get(0);

      if($element.prop("tagName").toLowerCase() !== 'textarea') {
        console.error('jQuery.Textarea.Autoresize works only on textarea tags, skipping...');
        console.log('Selected element is: ', $element);
        return;
      }

      $element.css('resize', 'none');
      if($self.params.maxHeight == false) {
        $element.css('overflow', 'hidden');
      }

      if($self.params.defaultHeight) {
        $element.on('focusout', function() {
          setTimeout(function() {
            $element.height($self.params.defaultHeight);
            $self.params.onResize($element);
          }, 0);
        });
      }

      $element.on('keydown cut paste drop focus', function() {
        setTimeout(function() {
          var height = $self.resetHeight();
          $element.finish().height(height);
          $self.params.onResize($element);
        }, 0);
      });
    },

    resetHeight: function() {
      var tmp = this.$element.height();
      this.$element.height(1);
      var scrollHeight = this.$element.get(0).scrollHeight;
      this.$element.height(tmp);

      return this.limitValue(scrollHeight, this.params.minHeight, this.params.maxHeight);
    },

    limitValue: function(value, min, max) {
      value = (min == false || value > min) ? value : min;
      value = (max == false || value < max) ? value : max;

      return value;
    }
  };

  $.fn.autoresize = function(params) {
    return this.each(function() {
      new Obj(this, params);
    });
  };
})(jQuery);

$(function() {
  $('textarea').autoresize({
    defaultHeight: 'min'
  });
});
