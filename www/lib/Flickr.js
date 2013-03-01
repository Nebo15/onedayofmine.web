var Flickr = {
	api_url:   'https://' + Config.instagram.host + '/',

	login: function(onLogin, onLoginError) {
		var child = window.open(Config.host + '/pages/flickr/');

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
						if(depth < max_depth) {
							Instagram._getShootsRecursive(url, function(next_shots) {
								$.merge(shots, next_shots);
								callback(shots);
							}, step_callback, max_depth, {
								max_id: media_response.pagination.next_max_id,
								depth: depth
							});
						} else {
							callback(shots);
						}
					} else {
						callback(shots);
					}
				}
			});
		});
	},

	getCurrentUserPhotos: function(callback, step_callback, max_depth) {
		Flickr.getUserPhotos('self', callback, step_callback, max_depth);
	},

	getUserPhotos: function(user_id, callback, step_callback, max_depth) {
		Instagram._getShootsRecursive('v1/users/' + user_id + '/media/recent', callback, step_callback, max_depth);
	},

	getCurrentUserFeed: function(callback, step_callback, max_depth) {
		Instagram.getUserFeed('self', callback, step_callback, max_depth);
	},

	getUserFeed: function(user_id, callback, step_callback, max_depth) {
		Instagram._getShootsRecursive('v1/users/' + user_id + '/feed', callback, step_callback, max_depth);
	}
};
