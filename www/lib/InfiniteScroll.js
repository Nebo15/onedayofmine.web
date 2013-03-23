/*
Usage:
  $('selector').infiniteScroll({
    request: [Request],
    step: 20
  });

Selector chields should have ID's in data-attribute:
  data-id = [ID]
*/

(function($) {
  "use strict";

    var __pluginName = 'infiniteScroll';

    var Obj = function($self, params) {
      this.$self = $self;
      this.params = params;

      this.init();
    };

    Obj.prototype = {
      init: function() {
        console.log(this.params);
        if(!this.params.request) {
          console.error('Request not specified');
          return;
        }

        var selector = this.$self;
        var template_list = Template.prepareTemplate($('#days_list_elements_template'));
        var template_button = Template.prepareTemplate($('#infiniteScroll_button_template'));
        var request = this.params.request;

        if(this.params.step) {
          request.params.data.limit = this.params.step || 40;
        }

        selector.append(Template.compileElement(template_button));
        var paginate_button = selector.find('.action-load-next');

        request.success(function(response) {
          var days = Template.compileElement(template_list, {
            days: response.data.result
          });

          days = $($.trim(days));

          selector.append(days).masonry( 'appended', days);

          setTimeout(function() {
            paginate_button.removeClass('disabled');
          }, 1000);
          paginate_button.hideSpinner();
        });

        $(window).on('scrollHitBottom', function() {
          if(paginate_button.hasClass('disabled')) {
            return;

          }
          paginate_button.addClass('disabled');
          paginate_button.showSpinner();

          var max_id = selector.find('[data-id]').last().data('id');
          request.params.data.from = max_id;
          request.send();
        });

      }
    };

    $.fn[__pluginName] = function(params) {
      return this.each(function() {
        new Obj($(this), params);
      });
    };
})(jQuery);
