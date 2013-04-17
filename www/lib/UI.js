$(function() {
  $.fn.extend({
    findSpinner: function() {
      if($(this).hasClass('has-spinner')) {
        return $(this);
      }

      return $(this).find('.has-spinner');
    },

    showSpinner: function() {
      $(this).addClass('active');
    },

    hideSpinner: function() {
      $(this).removeClass('active');
    },

    makeInvisible: function() {
      $(this).addClass('invisible');
    },

    attachValidator: function(params) {
      params = params || {};
      params.messages = params.messages || {};

      $this = $(this);

      var initial_value = $this.val();

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
        initial_value = $this.val();

        if(params.saveValidationState === true) {
          return;
        }

        $this.removeClass('error');

        if(params.button !== undefined) {
          params.button.removeClass('btn-danger');
        }
      };

      var onValidationError = function(message) {
        $this.addClass('error');

        if(message !== undefined) {
          showMessage(message);
        }

        if(params.button !== undefined) {
          params.button.addClass('btn-danger disabled');
        }

        if(typeof params.onError === 'function') {
          params.onError();
        }
      };

      var onValidationSuccess = function() {
        hideMessage();

        $this.removeClass('error');

        if(params.button !== undefined) {
          params.button.removeClass('btn-danger disabled');
        }

        if(typeof params.onSuccess === 'function') {
          params.onSuccess();
        }
      };

      $this.on('focusout', function() {
        hideMessage();
        resetControls();
      });

      var validate = function() {
        _value = $this.val();
        if(_value == initial_value) {
          return;
        }

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
