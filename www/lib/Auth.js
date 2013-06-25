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

  logout: function(onLogoutSuccess) {
    FB.logout(onLogoutSuccess);
  }
};

// Auth helpers for html
$(function(){
  // Logout
  var onLogoutSuccess = function($target) {
    API.setCurrentUser(undefined);
    $target.click();
    setTimeout(function() {
      console.log('Logged out');
      window.location.reload(); // Will be fired after all browser events fired
    }, 0);
  };

  var onLogoutFailed = function($target) {
    console.error('Logout failed!');
    $target.one('click', doLogout);
  };

  var doLogout = function(event) {
    if(!API.getCurrentUser()) {
      return;
    }

    event.stopImmediatePropagation();
    var $this = $(this);
    var $spinner = $this.findSpinner();

    if($spinner.length > 0) {
      $spinner.showSpinner();
    }

    API.logout(function() {
      $spinner.hideSpinner();
      onLogoutSuccess($this);
    }, function() {
      $spinner.hideSpinner();
      onLogoutFailed($this);
    });
  };

  $('.action-logout').one('click', doLogout);

  // Login
  var onLoginSuccess = function($target) {
    $target.click();
    setTimeout(function() {
      if(!$target.attr('href') || $target.attr('href') == '#') {
        window.location.reload(); // Will be fired after all browser events fired
      }
    }, 0);
  };

  var onLoginFailed = function($target) {
    $target.one('click', doLogin);
  };

  var doLogin = function(event) {
    if(API.getCurrentUser()) {
      return;
    }

    event.stopImmediatePropagation();
    var $this = $(this);
    var $spinner = $this.findSpinner();

    if($spinner.length > 0) {
      $spinner.showSpinner();
    }

    API.login(function() {
      $spinner.hideSpinner();
      onLoginSuccess($this);
    }, function() {
      $spinner.hideSpinner();
      onLoginFailed($this);
    });
  };

  $('.action-login').one('click', doLogin);
});
