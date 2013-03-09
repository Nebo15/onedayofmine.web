var Response = function(data, jqXHR, request) {
  var $this = this;
  var timestamp = new Date().getTime();

  function resetLimits() {
    delete request.params.data.from;
    delete request.params.data.to;
  }

  function setLimits(from, to) {
    resetLimits();

    if(from !== undefined) {
      request.params.data.from = from;
    }

    if(to !== undefined) {
      request.params.data.to = to;
    }
  }

  // Public prop
  this.data = data;
  this.timestamp = timestamp;
  this.jqXHR = jqXHR;

  // Public methods
  this.loadNext = function(callback, maxId) {
    var from;

    if(maxId !== undefined) {
      if(typeof maxId == "function") {
        from = maxId(data);
      } else {
        from = maxId;
      }
    } else {
      if($.isArray(data.result)) {
        var tmp = data.result.slice(-1)[0];
        if(tmp.id === undefined) {
          console.error("Can't detect maxId value, try to set in manually");
          return;
        }

        from = tmp.id;
      } else {
        console.error("data.result is not array, you should select maxId by you self");
        return;
      }
    }

    setLimits(from);
    request.success(function(response) {
      data.result = data.result.concat(response.data.result);
      $this.timestamp = response.timestamp;

      if(typeof callback === 'function')
        callback(data, response.data.result);
    }, typeof callback === 'function' ? true : false);
    request.send();

    return request;
  };

  this.loadPrev = function(callback, minId) {
    var to;

    if(minId !== undefined) {
      if(typeof minId == "function") {
        to = minId(data);
      } else {
        to = minId;
      }
    } else {
      if($.isArray(data.result)) {
        var tmp = data.result[0];
        if(tmp.id === undefined) {
          console.error("Can't detect minId value, try to set in manually");
          return;
        }

        to = tmp.id;
      } else {
        console.error("data.result is not array, you should select minId by you self");
        return;
      }
    }

    setLimits(undefined, to);
    request.success(function(response) {
      data.result = response.data.result.concat(data.result);
      $this.timestamp = response.timestamp;

      if(typeof callback === 'function')
        callback(data, response.data.result);
    }, typeof callback === 'function' ? true : false);
    request.send();

    return request;
  };

  // Don't select more than server return in one response!
  this.loadRange = function(from, to, callback) {
    setLimits(from, to);

    request.success(function(response) {
      data.result = response.data.result.concat(data.result);
      $this.timestamp = response.timestamp;

      if(callback)
        callback(data, response.data.result);
    }, true);
    request.send();
  };
};
