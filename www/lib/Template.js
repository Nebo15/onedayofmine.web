var Template = (function() {
  var templates_compiled = [];

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

  Handlebars.registerHelper('link', function(link)
  {
    link = link.replace('odom://', '#');
    link = link.replace('?', ':');
    return new Handlebars.SafeString(link);
  });

  Handlebars.registerHelper('clip', function(string, len) {
    console.log(string, len);
    if(null == string)
      return '';
    return new Handlebars.SafeString(string.substr(0, len - 1) + (string.length > len ? '&hellip;' : ''));
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

      if(callback)
        callback(html);

      return html;
    },

    renderElement: function(source, target, data, callback) {

        var tpl_code = typeof source == "string" ? source : source.html();
        var html = Template.compileElement(tpl_code, data);

        target.empty();
        target.html(html);

        if(callback)
            callback();
    }
  };
})();
