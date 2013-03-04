var API = (function() {
  var current_user;

  return {
    get: function(path, data, params)
    {
      return this.request('GET', path, data, params);
    },

    post: function(path, data, params)
    {
      return this.request('POST', path, data, params);
    },

    request: function(method, path, data, params)
    {
      var request = new Request(method, path, data, params);

      request.statusCodeGroup(4, function(jqXHR, textStatus, errorThrown) {
        var response = jQuery.parseJSON(jqXHR.responseText);
        alert(response.errors[0]);
      });

      request.statusCode(401, function() {
        console.log('Unauthorized access restricted');

        API.login(function() {
          console.log('Sending request with new credetials');
          request.send();
        }, function() {
          request.statusCode(401, function() {
            alert("Request needs authentication, but login failed!");
          });
        });
      });

      return request;
    },

    login: function(onLoginComplete, onLoginFail) {
      console.log('Logging in');
      var login_request = new Request('POST', 'auth/login', {async:false});

      login_request.success(function(response) {
        console.log('Logged in');
        API.setCurrentUser(response.data.result);

        $.event.trigger({
            type: 'login',
            user: response.data.result
        });

        onLoginComplete();
      }, true);

      login_request.error(function() {
        login_request.error(onLoginFail, true);

        console.log('Login attempt failed');
        Auth.login(function(token) {
          $.cookie('token', token, {
            expires: 31,
            // secure: true, // TODO: turn this on for security
            path: '/'
          });
          login_request.send();
        });
      }, true);

      login_request.send();
    },

    logout: function(callback) {
      console.log('Logging out');
      (new Request('GET', 'auth/logout', {async:false}).complete(function() {
          API.setCurrentUser(undefined);
          Storage.clear();
          $.removeCookie('token', {path: '/'});
          callback();
      })).send();
    },

    setCurrentUser: function(user) {
      current_user = user;
    },

    getCurrentUser: function() {
      return current_user;
    }
  };
})();
