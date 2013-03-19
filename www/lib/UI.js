$(function() {
  $.fn.extend({
    findSpinner: function() {
      return $(this).find('.with-spinner');
    },

    showSpinner: function() {
      var $this = $(this);
      var spinner = $this.children('.spinner');
      $this.addClass('show-spinner');

      var tmp = spinner.css('width'); // Dirty hack here
      spinner.css('width', 'auto');
      var width = spinner.width();
      spinner.css('width', tmp);

      spinner.finish().animate({width: width, opacity:1}, function() {
        spinner.css('display', 'inline-block');
      });
    },

    hideSpinner: function() {
      var $this = $(this);
      var spinner = $this.children('.spinner');

      $this.removeClass('show-spinner');
      spinner.finish().animate({width: 0, opacity:0}, function() {
        spinner.css('display', 'none');
      });
    },

    makeInvisible: function() {
      $(this).addClass('invisible');
    },

/*

 $('.search-query').attachValidator({
  button: $('button'),
  maxLength: 255,
  minLength: 5,
  canBeEmpty: false,
  isLive: false,
  messages: {
    empty: 'Search query is empty',
    minLength: 'Search query is too short',
    maxLength: 'Search query is too long'
  }
});*/

    attachValidator: function(params) {
      params = params || {};
      params.messages = params.messages || {};

      $this = $(this);

      var tooltip = $this.tooltip({
        placement: 'bottom',
        trigger: 'manual',
        animation: false
      });

      var hideMessage = function() {
        tooltip.tooltip('hide');
      };

      var showMessage = function(message) {
        tooltip.attr('data-original-title', message)
                .tooltip('fixTitle')
                .tooltip('show'); // TODO: Remove blinkins
      };

      var resetControls = function() {
        $this.removeClass('error');

        if(params.button !== undefined) {
          params.button.removeClass('btn-error');
        }
      };

      var onValidationError = function(message) {
        $this.addClass('error');

        if(message !== undefined) {
          showMessage(message);
        }

        if(params.button !== undefined) {
          params.button.addClass('btn-error disabled');
        }
      };

      var onValidationSuccess = function() {
        hideMessage();

        $this.removeClass('error');

        if(params.button !== undefined) {
          params.button.removeClass('btn-error disabled');
        }
      };

      $this.on('focusout', function() {
        hideMessage();
        resetControls();
      });

      var validate = function() {
        _value = $this.val();

        if($.trim(_value) === '' && (params.canBeEmpty === undefined || params.canBeEmpty === false)) {
          onValidationError(params.messages.empty);
        } else if(params.maxLength !== undefined && _value.length > params.maxLength) {
          onValidationError(params.messages.maxLength);
        } else if(params.minLength !== undefined && _value.length < params.minLength) {
          onValidationError(params.messages.minLength);
        } else {
          onValidationSuccess();
        }
      };

      if(params.button !== undefined) {
        params.button.click(function(event) {
          validate();

          if(params.button.hasClass('disabled')) {
            event.stopPropagation();
            event.preventDefault();
            return;
          }

          resetControls();
        });
      }

      $this.on('change keyup focusin', validate);

      resetControls();

      return $this;
    }
  });
});
