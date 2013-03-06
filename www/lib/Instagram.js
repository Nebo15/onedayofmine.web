var Instagram = {
  api_url:      '/instagram',
  redirect_uri: '/pages/oauth',

  isConnected: function() {
    return API.getCurrentUser() && API.getCurrentUser().instagram_connected === true;
  },

  loginDirect: function(redirect_uri) {
    redirect_uri = redirect_uri !== undefined ? redirect_uri : window.location;
    window.location = Instagram.api_url + '?oauth_redirect_url=' + encodeURIComponent(redirect_uri);
  },

  login: function(onLogin, onLoginError) {
    var child = window.open(Instagram.api_url + '?oauth_redirect_url=' + encodeURIComponent(Instagram.redirect_uri));

    var timer = setInterval(function() {
      if(child.closed) {
        clearInterval(timer);

        API.updateCurrentUser(function() {
          if(!Instagram.isConnected()) {
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
  },

  getUser: function(onUserInfoRecieved) {
    var user_request = API.request('GET', Instagram.api_url + '/user');

    user_request.success(function(response) {
      onUserInfoRecieved(response.data.result);
    }, true);

    user_request.error(function() {
      alert("We wasn't able to recive Instagram user info, please try to reload the page");
    }, true);

    user_request.send();
  },

  getUserPhotos: function(onPhotosRecieved, params) {
    var photo_request = API.request('GET', Instagram.api_url + '/photos');

    photo_request.success(function(response) {
      onPhotosRecieved(response.data.result, function() {
        response.loadNext(undefined, function(data) {
          return data.result.slice(-1)[0].time;
        });
      });
    }, true);

    photo_request.error(function() {
      alert("We wasn't able to recive Instagram user info, please try to reload the page");
    }, true);

    photo_request.send();
  },

  getUserDays: function(onPhotosRecieved) {
    var days_request = API.request('GET', Instagram.api_url + '/days');

    days_request.success(function(response) {
      onPhotosRecieved(response.data.result, function() {
        response.loadNext(undefined, function(data) {
          return data.result.slice(-1)[0].slice(-1)[0].time;
        });
      });
    }, true);

    days_request.error(function() {
      alert("We wasn't able to recive Instagram user info, please try to reload the page");
    }, true);

    days_request.send();
  }
};
