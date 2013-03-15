var Auth = {
  login: function(onLoginSuccess) {
    FB.getLoginStatus(function(cached_response) {
      if (cached_response.status === 'connected') {
        var token = cached_response.authResponse.accessToken;
        console.log('FB token already set: ' + token);
        return onLoginSuccess(token);
      } else {

				$('#invite_modal').modal('show');
				$('#invite_modal').find('button').click(function() {
					var code = $('#invite_modal').find('input[type=text]').val();
					API.post('auth/check_invitation', {code: code}).success(function(resp) {
						if(false == resp.data.result)
						{
							$('#invite_modal').find('input').parent().parent().addClass('error');
							return;
						}
						FB.login(function(response) {
          		if(response.authResponse) {
								var token = response.authResponse.accessToken;
								console.log('FB token recieved: ' + token);
								new Request('POST', 'auth/login', {token:token, invitation_code:code}, {async:false}).success(function(){
									return onLoginSuccess(token, code);
								}).send();
							} else {
								alert('You need to authorize application to continue using it');
							}
						});
					}).send();
				});
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
