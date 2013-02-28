jQuery.getCachedScript = function(url, options) {
  // allow user to set any option except for dataType, cache, and url
  options = $.extend(options || {}, {
    dataType: "script",
    cache: true,
    url: url
  });

  // Use $.ajax() since it is more flexible than $.getScript
  // Return the jqXHR object so we can chain callbacks
  return jQuery.ajax(options);
};

var Request = function(method, path, data, params) {
  // This
  var $this = this;

  // URLs
  var host = Config.host;
  var url  = 'http://' + host + '/' + path;

  // Event callbacks
  var callbacks = {
    // Always before request
    // function(xhr) {}
    before: [],

    // HTTP 4XX - 5XX, and jqXHR errors
    // function(jqXHR, textStatus, errorThrown)
    error: [],

    // Always after reuqest
    // function(jqXHR, textStatus) {}
    complete: [],

    // HTTP 20X
    // function(response) {}
    success: [],

    // Always after request, if code triggered all event listeners won't be called
    // function(jqXHR, textStatus, errorThrown) {}
    statusCodes: [],

    // Always after status codes, if code group triggered all event listeners won't be called
    // function(jqXHR, textStatus, errorThrown) {}
    statusGroups: []
  };

  function trigger(callbacks_arr, args, code) {
    if(callbacks.statusCodes[code]) {
      callbacks.statusCodes[code].apply($this, args);
    } else {
      var code_group = Math.floor(code/100);

      if(callbacks.statusGroups[code_group]) {
        callbacks.statusGroups[code_group].apply($this, args);
      }

      $.each(callbacks_arr, function(index, callback) {
        callback.apply($this, args);
      });
    }
  }

  params = $.extend(true, {
    type:     method.toUpperCase() == 'POST' ? 'POST' : 'GET',
    url:      url,
    dataType: 'json',
    data:     data,
    cache:    false
  }, params);

  // Public methods
  this.params = params;

  this.before = function(callback, reset) {
    if(reset) {
      callbacks.before = [];
    }

    callbacks.before.push(callback);

    return this;
  };

  this.success = function(callback, reset) {
    if(reset) {
      callbacks.success = [];
    }

    callbacks.success.push(callback);

    return this;
  };

  this.error = function(callback, reset) {
    if(reset) {
      callbacks.error = [];
    }

    callbacks.error.push(callback);

    return this;
  };

  this.complete = function(callback, reset) {
    if(reset) {
      callbacks.complete = [];
    }

    callbacks.complete.push(callback);

    return this;
  };

  this.statusCode = function(code, callback) {
    if(Math.floor(code/100) == 2) {
      alert('Use success(...) instead of statusCode(2XX, ...)!');
    }

    callbacks.statusCodes[code] = callback;

    return this;
  };

  this.statusCodeGroup = function(codeGroup, callback) {
    if(codeGroup == 2) {
      alert('Use success(...) instead of statusCodeGroup(2, ...)!');
    }

    callbacks.statusGroups[codeGroup] = callback;

    return this;
  };

  this.send = function(tmp_params) {
    params = $.extend(true, params, tmp_params);

    return $.ajax($.extend(true, {
      beforeSend: function(jqXHR) {
        // jqXHR.setRequestHeader("Cache-Control", "no-cache");
        // jqXHR.setRequestHeader("Pragma", "no-cache");

        trigger(callbacks.before, [jqXHR]);
      },

      success: function(data, textStatus, jqXHR) {
        console.log('Request ' + textStatus + ' (' + jqXHR.status + '): ' + path);

        trigger(callbacks.success, [new Response(data, jqXHR, $this)], jqXHR.status);
      },

      error: function(jqXHR, textStatus, errorThrown) {
        console.log('Request ' + textStatus + ' (' + jqXHR.status + '): ' + errorThrown);

        trigger(callbacks.error, [jqXHR, textStatus, errorThrown], jqXHR.status);
      },

      complete: function(jqXHR, textStatus) {
        trigger(callbacks.complete, [jqXHR, textStatus]);
      }
    }, params));
  };
};
