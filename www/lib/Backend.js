// Methods to work with API
var Backend = {
    //Host: 'http://stage.onedayofmine.com/',
    Host: 'http://odom.local:8080/',

    SyncAjax: function(method, path, data, params) {

        if (FB.getAuthResponse().accessToken) {
            data = $.extend(data, {token:FB.getAuthResponse().accessToken});
        }

        return $.ajax($.extend({
            type:   method.toUpperCase() == 'POST' ? 'POST' : 'GET',
            url:    Backend.Host + path,
            dataType: 'json',
            data:   data,
            cache:  false
        }, params));
    },

    Request: function(method, path, data) {
        var def = new $.Deferred();

        var status_codes = {
            200: function() {
                console.log('Request completed');
            },

            404: function() {
                alert('Page not found', function() { def.reject(); });
            },

            401: function() {
                alert('Server needs authorization, but auto-login failed', function() { def.reject(); });
            }
        };

        var params = {
            statusCode: status_codes
        };

        var overrided_params = {
            statusCode: $.extend({}, status_codes, {
                401: function() {
                    Loader.setStatus('Server needs authorization');
                    return Backend.Login(function() {
                        Loader.setStatus('Re-trying request');
                        Backend.SyncAjax(method, path, data, params).done(function(data, a) {
                            def.resolve(data, a);
                        });
                    });
                }
            })
        };

        this.SyncAjax(method, path, data, overrided_params).done(function(data, a) {
            def.resolve(data, a);
        });

        return def;
    },

    PostRequest: function(path, data) {
        return this.Request('POST', path, data);
    },

    GetRequest: function(path, data) {
        return this.Request('GET', path, data);
    },

    Login: function(onSuccessfulLogin) {
        Loader.setStatus('Logging in');

        var onError = function(a, b) {
            console.log(a, b);
            Loader.setStatus('Login attempt failed');
            console.log('Logging in with new token');
            Auth.getAccessToken(requestLogin);
        };

        var requestLogin = function(token) {
            Loader.setStatus('Sending credetials to backend');
            console.log('Using token = ' + token);

            var req = Backend.SyncAjax('POST', 'auth/login?rand='+(new Date().getTime()), {token: token});
            req.done(onSuccessfulLogin());
            req.fail(onError);
        };

        if (typeof localStorage.token == "string") {
            requestLogin(localStorage.token);
        } else {
            console.log('FB Access Token is invalid or not set');
            requestLogin(FB.getAuthResponse().accessToken);
        }
    },

    Logout: function(callback) {
        console.log('Logging out');
        console.log('Dropping LocalStorage cache');
        Storage.clear();
        Backend.SyncAjax('GET', '/auth/logout');
        Navigation.redirectToDefaultPage();
    },

    getCurrentUser: function() {
        return JSON.parse(localStorage.user);
    }
};
