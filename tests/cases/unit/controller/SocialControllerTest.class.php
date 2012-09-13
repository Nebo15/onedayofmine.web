<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/UsersController.class.php');

class SocialControllerTest extends odControllerTestCase
{
  protected $controller_class = 'SocialController';

  function testFacebookFriends()
  {
    $this->main_user->save();
    lmbToolkit::instance()->setUser($this->main_user);
    $friends = $this->get('facebook_friends');
    $this->assertResponse(200);
  }

  function testFacebookInvite()
  {
    $this->main_user->save();
    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('facebook_invite', array('uid' => $this->additional_user->getFacebookUid()));
    $this->assertResponse(200);
  }

  function testFacebookInvite_registeredUser()
  {
    $this->additional_user->save();
    $this->main_user->save();
    lmbToolkit::instance()->setUser($this->main_user);
    $resp = $this->post('facebook_invite', array('uid' => $this->additional_user->getFacebookUid()));
    $this->assertResponse(200);
    $this->assertEqual($resp->result, 'User is already registered');
  }

  function testEmailInvite()
  {
    $this->main_user->save();
    lmbToolkit::instance()->setUser($this->main_user);

    $this->post('email', [
      'email' => $email = 'test@mail.com',
      'name' => $name = 'foo'
    ], 'invite')->result;
    $this->assertResponse(200);

    $mailer = $this->toolkit->getMailer();
    $this->assertEqual($email, $mailer->recipient);
    $this->assertEqual("Invitation to One Day of Mine", $mailer->subject);
    $this->assertPattern('/'.$name.'/', $mailer->text);
  }
}
