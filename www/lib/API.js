var API = (function() {
  function setRequestToken(request) {
    if(request.params.data === undefined)
      request.params.data = {};

    request.params.data.token = Storage.get('token');
  }

  return {

    request: function(method, path, data, params)
    {
      var request = new Request(method, path, data, params);

      request.statusCodeGroup(4, function(jqXHR, textStatus, errorThrown) {
        Loader.hide();
        var response = jQuery.parseJSON(jqXHR.responseText);
        alert(response.errors[0]);
      });

      if(Storage.get('token')) {
        setRequestToken(request);
      }

      request.statusCode(401, function() {
        Loader.setStatus('Unauthorized access restricted');

        API.login(function() {
          Loader.setStatus('Sending request with new credetials');
          setRequestToken(request);
          request.send();
        }, function() {
          request.statusCode(401, function() {
            alert("Request needs authentication, but login failed!");
          });
        });
      });

      request.statusCode(404, function() {
        alert('Page not found!');
      });

      return request;
    },

    login: function(onLoginComplete, onLoginFail) {
      Loader.setStatus('Logging in');
      var login_request = new Request('POST', 'auth/login', {async:false});

      login_request.success(function(response) {
        Loader.setStatus('Logged in');
        Storage.set('user', response.data.result);

        $.event.trigger({
            type: 'login',
            user: response.data.result
        });

        onLoginComplete();
      }, true);

      login_request.error(function() {
        login_request.error(onLoginFail, true);

        Loader.setStatus('Login attempt failed');
        Auth.getAccessToken(doLogin);
      }, true);

      var doLogin = function() {
        setRequestToken(login_request);
        login_request.send();
      };

      if (Storage.get('token')) {
        setRequestToken(login_request);
        doLogin();
      } else {
        console.log('Access token not set');
        Auth.getAccessToken(doLogin);
      }
    },

    logout: function(callback) {
      console.log('Logging out');
      console.log('Dropping LocalStorage cache');
      (new Request('GET', 'auth/logout', {async:false}).complete(function() {
          Storage.clear();
          callback();
      })).send();
    }
  };
})();
