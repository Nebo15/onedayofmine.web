var Response = function(data, jqXHR, request) {
  var $this = this;
  var timestamp = new Date().getTime();

  function resetLimits() {
    delete request.params.data.from;
    delete request.params.data.to;
  }

  // Public prop
  this.data = data;
  this.timestamp = timestamp;
  this.jqXHR = jqXHR;

  // Public methods
  this.loadNext = function(callback) {
    resetLimits();
    request.params.data.from = data.result[data.result.length-1].id;
    request.success(function(response) {
      data.result = data.result.concat(response.data.result);
      $this.timestamp = response.timestamp;

      if(callback)
        callback(data, response.data.result);
    }, true);
    request.send();
  };

  this.loadPrev = function(callback) {
    resetLimits();
    request.params.data.to = data.result[0].id;
    request.success(function(response) {
      data.result = response.data.result.concat(data.result);
      $this.timestamp = response.timestamp;

      if(callback)
        callback(data, response.data.result);
    }, true);
    request.send();
  };
};
