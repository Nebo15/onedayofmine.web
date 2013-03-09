var Importer = function(source) {
  var _instance = this;
  // Data
  var api_url = '/' + source;
  var redirect_uri = '/pages/oauth';

  this.getSourceName = function() {
    return source;
  };

  this.isConnected = function() {
    return source == 'facebook' || API.getCurrentUser() && API.getCurrentUser()[source + '_connected'] === true;
  };

  this.loginDirect = function(redirect_uri) {
    redirect_uri = redirect_uri !== undefined ? redirect_uri : window.location;
    window.location = api_url + '/login?oauth_redirect_url=' + encodeURIComponent(redirect_uri);
  };

  this.login = function(onLogin, onLoginError) {
    var child = window.open(api_url + '/login?oauth_redirect_url=' + encodeURIComponent(redirect_uri));

    var timer = setInterval(function() {
      if(child.closed) {
        clearInterval(timer);

        API.updateCurrentUser(function() {
        if(!_instance.isConnected()) {
            if(onLoginError) {
              onLoginError();
            } else {
              alert("User didn't fully authorized");
            }
          } else {
            onLogin();
          }
        });
      }
    }, 200);
  };

  this.getUser = function(onUserInfoRecieved) {
    var user_request = API.request('GET', api_url + '/user');

    user_request.success(function(response) {
      onUserInfoRecieved(response.data.result);
    }, true);

    user_request.error(function() {
      alert("We wasn't able to recive '" + source + "' user info, please try to reload the page");
    }, true);

    user_request.send();
  };

  this.getUserPhotos = function(onPhotosRecieved, params, callbacks) {
    var photo_request = API.request('GET', api_url + '/photos', params);

    photo_request.success(function(response) {
      var next_callback = function(onNextPhotosRecieved) {
        return response.loadNext(typeof onNextPhotosRecieved === 'function' ? onNextPhotosRecieved : callbacks.onNextPhotosRecieved, function(data) {
          if(data.result.length === 0) {
            console.log("Result list is empty, loadNext will take 0 as param");
            return 0;
          }
          return data.result.slice(-1)[0].time;
        });
      };

      var prev_callback = function(onPrevPhotosRecieved) {
        return response.loadPrev(typeof onPrevPhotosRecieved === 'function' ? onPrevPhotosRecieved : callbacks.onPrevPhotosRecieved, function(data) {
          if(data.result.length === 0) {
            console.error("Can't find minId");
          }
          return data.result[0].time;
        });
      };

      onPhotosRecieved(response.data.result, next_callback, prev_callback);
    }, true);

    photo_request.error(function() {
      alert("We wasn't able to recive '" + source + "' user photos, please try to reload the page");
    }, true);

    photo_request.send();
  };

  this.getUserDays = function(onPhotosRecieved) {
    var days_request = API.request('GET', api_url + '/days');

    days_request.success(function(response) {
      onPhotosRecieved(response.data.result, function() {
        response.loadNext(undefined, function(data) {
          return data.result.slice(-1)[0].slice(-1)[0].time;
        });
      });
    }, true);

    days_request.error(function() {
      alert("We wasn't able to recive '" + source + "' user days, please try to reload the page");
    }, true);

    days_request.send();
  };
};
