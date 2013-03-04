var Auth = {
  login: function(onLoginSuccess) {
    FB.getLoginStatus(function(cached_response) {
      if (cached_response.status === 'connected') {
        var token = cached_response.authResponse.accessToken;
        console.log('Token recieved: ' + token);
        return onLoginSuccess(token);
      } else {
        FB.login(function(response) {
          if(response.authResponse) {
            var token = response.authResponse.accessToken;
            console.log('Token recieved: ' + token);
            return onLoginSuccess(token);
          } else {
            alert('You need to authorize application to continue using it');
          }
        });
      }
    });
  },

  logout: function(callback) {
    FB.logout(function(response) {
        callback();
    });
  }
};
