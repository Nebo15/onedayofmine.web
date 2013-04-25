var API = (function() {
  "use strict";
  var current_user;

  return {
    get: function(path, data, params) {
      return this.request('GET', path, data, params);
    },

    post: function(path, data, params) {
      return this.request('POST', path, data, params);
    },

    request: function(method, path, data, params) {
      var request = new Request(method, path, data, params);

      request.statusCodeGroup(4, function(jqXHR, textStatus, errorThrown) {
        var response = jQuery.parseJSON(jqXHR.responseText);
        alert(response.errors[0]);
      });

      request.statusCode(401, function() {
        console.log('Unauthorized access restricted');

        API.login(function() {
          console.log('Sending request with new credentials');
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

      var makeTry = function() {
        Auth.login(function(token) {
          $.cookie('token', token, {
            expires: 31,
            path: '/'
          });
          login_request.send();
        });
      };

      login_request.error(function(jqXHR) {
        login_request.error(onLoginFail, true);

				if(412 == jqXHR.status) {
          var response = jQuery.parseJSON(jqXHR.responseText);
          if(response.errors[0] === "Invitation not given") {
            console.log('Invitation not given');
            var modal_selector = $('#invite_modal');
            modal_selector.modal('show');

            modal_selector.on('hidden', function() {
              if(typeof onLoginFail === 'function')
                onLoginFail();
            });

            modal_selector.find('.action-sign-in').click(function() {
              var $this = $(this);
              $this.showSpinner();

              var invitation_code = modal_selector.find('input[type=text]').val();

              var invitation_code_request = API.post('/auth/check_invitation', {
                code: invitation_code
              });

              invitation_code_request.success(function(invitation_code_response)
							{
                if(invitation_code_response.data.result === false) {
                  modal_selector.find('input[type=text]').addClass('error');
                  modal_selector.find('.alert').removeClass('hide');
									$this.hideSpinner();
                } else {
                  modal_selector.find('input[type=text]').removeClass('error');
                  modal_selector.find('.alert').addClass('hide');
                  login_request.params.data.invitation_code = invitation_code;
                  makeTry();
                }
              });

              invitation_code_request.error(function() {
                $this.hideSpinner();
                alert("We wasn't able to validate you're invitation code, try again later or write to us");
              });

              invitation_code_request.send();
            });

            return;
          }
        }

        console.log('Login attempt failed');
        makeTry();
      }, true);

      makeTry();
    },

    logout: function(callback) {
      console.log('Logging out');
      (new Request('GET', 'auth/logout', {async:false}).complete(function() {
        API.setCurrentUser(undefined);
        Storage.clear();
        $.removeCookie('token', {path: '/'});
        Auth.logout();
        callback();
      })).send();
    },

    setCurrentUser: function(user) {
      current_user = user;
    },

    getCurrentUser: function() {
      return current_user;
    },

    updateCurrentUser: function(onUserInfoRecieved) {
      var user_update_request = API.request('GET', 'users/me');

      user_update_request.success(function(response) {
        API.setCurrentUser(response.data.result);

        if(onUserInfoRecieved) {
          onUserInfoRecieved(API.getCurrentUser());
        }
      }, true);

      user_update_request.error(function() {
        alert("User info can't be updated, please try to reload the page");
      }, true);

      user_update_request.send();
    }
  };
})();
