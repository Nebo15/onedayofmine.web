var Auth = {
  login: function(onLoginSuccess) {
    FB.getLoginStatus(function(cached_response) {
      if (cached_response.status === 'connected') {
        var token = cached_response.authResponse.accessToken;
        console.log('FB token already set: ' + token);
        return onLoginSuccess(token);
      } else {
        FB.login(function(response) {
          if(response.authResponse) {
            var token = response.authResponse.accessToken;
            console.log('FB token recieved: ' + token);
            return onLoginSuccess(token);
          } else {
            alert('You need to authorize application to continue using it');
						window.location.href = '/';
          }
        }, {scope: Config.facebook.scope});
      }
    });
  },

  logout: function(callback) {
    FB.logout(function(response) {
      if(callback) {
        callback();
      }
    });
  }
};
