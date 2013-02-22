var Auth = {
  login: function(onLoginSuccess) {
    FB.login(function(response) {
      if(response.authResponse) {
        var token = response.authResponse.accessToken;
        console.log('Token recieved: ' + token);
        Storage.set('token', token);
        return onLoginSuccess(token);
      } else {
        alert('You need to authorize application to continue using it');
      }
    });
  },

  hasAccessToken: function() {
    var token = Storage.get('token');
    return (token !== undefined && typeof token === "string");
  },

  getAccessToken: function(onTokenRecieved) {
    FB.getLoginStatus(function(response) {
      if(Auth.hasAccessToken() && response.status === 'connected') {
        return onTokenRecieved(Storage.get('token'));
      } else {
        Auth.login(function(token) {
          onTokenRecieved(token);
        });
      }
    });
  },

  logout: function(callback) {
    Storage.set('token', null);
    FB.logout(function(response) {
        callback();
    });
  }
};
