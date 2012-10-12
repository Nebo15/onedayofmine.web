<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/UsersController.class.php');
lmb_require('src/model/Day.class.php');

class SocialControllerTest extends odControllerTestCase
{
  protected $controller_class = 'SocialController';

  function testFacebookFriends()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $following = $this->main_user->getFollowing();
    $following->add($this->additional_user);
    $following->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $profile = $this->toolkit->getFacebookProfile($this->main_user);
    $profile->expectOnce('getFriends');
    $profile->setReturnValue('getFriends', [$this->generator->facebookInfo($this->additional_user->facebook_uid), $this->generator->facebookInfo()]);

    $response = $this->get('facebook_friends');
    if($this->assertResponse(200))
    {
      $friends = $response->result;
      $this->assertTrue(is_array($friends));
      $this->assertEqual(count($friends), 2);

      $this->assertJsonFacebookUserItems($friends);
    }
  }

  function testFacebookInvite()
  {
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $profile = $this->toolkit->getFacebookProfile($this->main_user);
    $profile->expectOnce('shareInvitation');

    $response = $this->post('facebook_invite', [
      'uid' => $this->additional_user->facebook_uid
    ]);

    if($this->assertResponse(200))
      $this->assertTrue(is_null($response->result));
  }

  function testFacebookInvite_RegisteredUser()
  {
    $this->additional_user->save();
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $profile = $this->toolkit->getFacebookProfile($this->main_user);
    $profile->expectNever('shareInvitation');

    $response = $this->post('facebook_invite', [
      'uid' => $this->additional_user->facebook_uid
    ]);
    if($this->assertResponse(200))
      $this->assertEqual($response->result, 'User is already registered');
  }

  function testEmailInvite()
  {
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $this->post('email', [
      'email' => $email = 'test@mail.com',
      'name' => $name = 'foo'
    ], 'invite');
    if($this->assertResponse(200))
    {
      $mailer = $this->toolkit->getMailer();
      $this->assertEqual($email, $mailer->recipient);
      $this->assertEqual("Invitation to One Day of Mine", $mailer->subject);
      $this->assertPattern('/'.$name.'/', $mailer->text);
    }
  }
}
