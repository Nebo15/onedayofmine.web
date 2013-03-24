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
        if(!this.params.request) {
          console.error('Request not specified');
          return;
        }

        var selector = this.$self;
        var template_button = Template.prepareTemplate($('#infiniteScroll_button_template'));
        var request = this.params.request;
        var onSuccess = this.params.success;
        var order = this.params.order || 'ASC';

        if(this.params.step) {
          request.params.data.limit = this.params.step || 40;
        }

        selector.append(Template.compileElement(template_button));
        var paginate_button = selector.find('.infiniteScroll_button_container button');

        request.success(function(response) {
          console.log(response);
          if(response.data.code == 200 && response.data.result.length > 0) {
            onSuccess.call(selector, response);

            setTimeout(function() {
              paginate_button.removeClass('disabled');
            }, 1000);
          } else {
            paginate_button.animate({opacity:0});
          }

          paginate_button.hideSpinner();
        });

        var paginate_callback = function() {
          if(paginate_button.hasClass('disabled')) {
            return;

          }
          paginate_button.addClass('disabled');
          paginate_button.showSpinner();

          var last_id = selector.find('[data-id]').last().data('id');
          if(order == 'DESC') {
            request.params.data.to = last_id;
          } else {
            request.params.data.from = last_id;
          }
          request.send();
        };

        $(window).on('scrollHitBottom', paginate_callback);
        paginate_button.click(paginate_callback);
      }
    };

    $.fn[__pluginName] = function(params) {
      return this.each(function() {
        new Obj($(this), params);
      });
    };
})(jQuery);
