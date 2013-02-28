var Instagram = {
  api_host:  Config.instagram.host,
  api_url:   'https://' + Config.instagram.host + '/',
  client_id: Config.instagram.client_id,
  redirect_uri: Config.instagram.redirect_url,

  getAccessToken: function(onTokenRecieved, onTokenError) {
    if(!Instagram.hasAccessToken()) {
      Instagram.login(onTokenRecieved, onTokenError);
    } else if(onTokenRecieved !== undefined) {
      onTokenRecieved(Storage.get('instagram_token'));
    }
  },

  hasAccessToken: function() {
    return Storage.get('instagram_token') !== undefined && Storage.get('instagram_token');
  },

  login: function(onLogin, onLoginError) {
    var child = window.open(Instagram.api_url + 'oauth/authorize/?client_id='+Instagram.client_id+'&redirect_uri='+Instagram.redirect_uri+'&response_type=token');

    var timer = setInterval(function() {
      if(child.closed) {
        clearInterval(timer);
        var token = Storage.get('instagram_token');
        console.log('Instagram token recived: ' + token);
        if(token !== undefined && token) {
          if(onLogin !== undefined) {
            onLogin(token);
          }
        } else {
          if(onLoginError !== undefined) {
            onLoginError();
          } else {
            alert("User didn't fully authorized");
          }
        }
      }
    }, 200);
  },

  getCurrentUser: function(callback) {
    Instagram.getAccessToken(function(token) {
      $.ajax({
        dataType:"jsonp",
        url: Instagram.api_url +'v1/users/self',
        data:{
          access_token: token
        },
        cache:true,
        success:function (user_response) {
          callback(user_response.data);
        }
      });
    });
  },

  getUser: function(name, callback) {
    Instagram.getAccessToken(function(token) {
      $.ajax({
        dataType:"jsonp",
        url: Instagram.api_url + 'v1/users/search',
        data:{
          access_token: token,
          q: name
        },
        cache:true,
        success:function (user_response) {
          callback(user_response.data);
        }
      });
    });
  },

  _getShootsRecursive: function(url, callback, step_callback, max_depth, params) {
    params = params || {};
    max_depth = max_depth === undefined ? 10 : max_depth;
    var depth = params.depth === undefined ? 0 : params.depth;

    Instagram.getAccessToken(function(token) {
      $.ajax({
        dataType:"jsonp",
        url: Instagram.api_url + url,
        data:$.extend({}, params, {
          access_token: token
        }),
        cache:true,
        success:function (media_response) {
          var shots = [];
          $.merge(shots, media_response.data);

          depth++;

          if(step_callback !== undefined) {
            step_callback(depth, max_depth, shots);
          }

          if(media_response.pagination !== undefined && media_response.pagination.next_max_id !== undefined) {
            var get_next = function() {
              Instagram._getShootsRecursive(url, function(next_shots, next_callback) {
                $.merge(shots, next_shots);
                callback(shots, next_callback);
              }, step_callback, max_depth, {
                max_id: media_response.pagination.next_max_id,
                depth: depth
              });
            };

            if(depth < max_depth) {
              get_next(callback);
            } else {
              depth = 0;
              callback(shots, function() {
                get_next();
                // media_response.pagination.next_max_id
              });
            }
          } else {
            callback(shots);
          }
        }
      });
    });
  },

  getCurrentUserPhotos: function(callback, step_callback, max_depth, params) {
    Instagram.getUserPhotos('self', callback, step_callback, max_depth, params);
  },

  getUserPhotos: function(user_id, callback, step_callback, max_depth, params) {
    Instagram._getShootsRecursive('v1/users/' + user_id + '/media/recent', callback, step_callback, max_depth, params);
  },

  getCurrentUserFeed: function(callback, step_callback, max_depth, params) {
    Instagram.getUserFeed('self', callback, step_callback, max_depth);
  },

  getUserFeed: function(user_id, callback, step_callback, max_depth, params) {
    Instagram._getShootsRecursive('v1/users/' + user_id + '/feed', callback, step_callback, max_depth, params);
  }
};
