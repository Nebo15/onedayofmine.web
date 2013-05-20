var Template = (function() {
  var templates_compiled = [];

  $(function() {

		Handlebars.registerHelper('raw', function(text, context) {
			return new Handlebars.SafeString(text);
		});

    // Registering Handlebars helpers
    Handlebars.registerHelper('include', function(name, context) {
      var subTemplate = Handlebars.compile($(name));
      var subTemplateContext = $.extend({}, this, context.hash);

      return new Handlebars.SafeString(subTemplate(subTemplateContext));
    });

    Handlebars.registerHelper('if-eq', function(first, second, options) {
      if(first == second) {
        return options.fn(this);
      } else {
        return options.inverse(this);
      }
    });

    Handlebars.registerHelper('if-gt', function(first, second, options) {
      if(first > second) {
        return options.fn(this);
      } else {
        return options.inverse(this);
      }
    });

    Handlebars.registerHelper('if-lt', function(first, second, options) {
      if(first < second) {
        return options.fn(this);
      } else {
        return options.inverse(this);
      }
    });

    Handlebars.registerHelper('if-neq', function(first, second, options) {
      if(first != second) {
        return options.fn(this);
      } else {
        return options.inverse(this);
      }
    });

		Handlebars.registerHelper('prettydate', function(timestamp, options) {
			return Tools.prettyDate(timestamp * 1000);
		});

		Handlebars.registerHelper('date', function(timestamp, options) {
			return Tools.getDate(timestamp);
		});

  });

  return {
    prepareTemplate: function(template) {
      return template.html().split('[[').join('{{').split(']]').join('}}');
    },

    compileElement: function(source, data, callback) {
      if(!templates_compiled[source.hashCode()]) {
        templates_compiled[source.hashCode()] = Handlebars.compile(source);
      }

      var html = templates_compiled[source.hashCode()](data);

      if(callback) {
        callback(html);
      }

      return html;
    },

    renderElement: function(source, target, data, callback) {
        var tpl_code = typeof source == "string" ? source : source.html();
        var html = Template.compileElement(tpl_code, data);

        target.empty();
        target.html(html);

        if(callback) {
          callback();
        }
    }
  };
})();
