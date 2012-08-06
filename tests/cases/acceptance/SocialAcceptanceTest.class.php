<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');

class SocialAcceptanceTest extends odAcceptanceTestCase
{
  /**
   * @api
   */
  function testFacebookFiends()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $this->_loginAndSetCookie($this->main_user);

    $result = $this->get('social/facebook_friends');
    $friends = $result->result;
    $this->assertResponse(200);
    $this->assertTrue(is_array($friends));
    $this->assertEqual(1, count($friends));
    $this->assertEqual($friends[0]->fb_uid, $this->additional_user->getFbUid());
  }

  /**
   * example
   * TODO
   */
  function testFacebookInvite() {}

  /**
   * @api
   */
  function testTwitterConnect()
  {
    $this->main_user->save();
    $this->_loginAndSetCookie($this->main_user);
    $result = $this->post('social/twitter_connect', array(
      'access_token'         => $this->generator->twitter_credentials()[0]['access_token'],
      'access_token_secret'  => $this->generator->twitter_credentials()[0]['access_token_secret']
    ));
    $user = User::findOne();
    if($this->assertResponse(200)) {
      $this->assertTrue($user->getTwitterUid());
      $this->assertEqual($result->result->twitter_uid, $user->getTwitterUid());
      $this->assertEqual($user->getTwitterUid(), $this->generator->twitter_credentials()[0]['uid']);
      $this->assertEqual($user->getTwitterAccessToken(), $this->generator->twitter_credentials()[0]['access_token']);
      $this->assertEqual($user->getTwitterAccessTokenSecret(), $this->generator->twitter_credentials()[0]['access_token_secret']);
    }
  }

  // TODO cache dont work on invalid tokens
  function testTwitterConnect_withUnvalidCredentials()
  {
    $this->main_user->save();
    $this->_loginAndSetCookie($this->main_user);
    $result = $this->post('social/twitter_connect', array(
      'access_token'         => 'Wrong twitter access token',
      'access_token_secret'  => 'Wrong twitter access token secret'
    ));
    if($this->assertResponse(403)) {
      $this->assertEqual($result->errors[0]->message, 'Access token seems to be unvalid.');
    }
  }

  function testTwitterConnect_withNoField()
  {
    $this->main_user->save();
    $this->_loginAndSetCookie($this->main_user);
    $result = $this->post('social/twitter_connect', array(
      'access_token'         => $this->generator->twitter_credentials()[0]['access_token']
    ));
    $this->assertResponse(400);
  }

  /**
   * @api description Returns news for current logged in user.
   * @api input param int from
   * @api input param int to
   * @api input param int limit
   * @api result News[] - List of news. If you use the "from" option (wthout "to") and returned list is empty, than additionally HTTP 304 status code can be returned.
   */
  function testGetNewNews() {
    $this->main_user->save(); // Save user to have static ID
    $this->_loginAndSetCookie($this->main_user);

    $response = $this->get('social/news');
    $this->assertResponse(200);
    $this->assertEqual(0, count($response->result));

    // Adding new news
    $news1 = $this->generator->news(null, $this->main_user);
    $news1->save();
    $news2 = $this->generator->news(null, $this->main_user);
    $news2->save();
    $news3 = $this->generator->news(null, $this->main_user);
    $moment = $this->generator->moment();
    $moment->setDay($this->generator->day());
    $moment->save();
    $news3->setMoment($moment);
    $news3->save();
    $news4 = $this->generator->news(null, $this->main_user);
    $news4->save();

    $response = $this->get('social/news');
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_array($response->result));
      $this->assertEqual(4, count($response->result));
      $this->assertEqual($news4->getId(), $response->result[0]->id);
      $this->assertEqual($news3->getId(), $response->result[1]->id);
      $this->assertEqual($news2->getId(), $response->result[2]->id);
      $this->assertEqual($news1->getId(), $response->result[3]->id);
    }

    // If there are no new news return shoud be empty with HTTP 304 status code
    $response = $this->get('social/news', array('from' => $news1->getId()));
    $this->assertResponse(304);
    $this->assertEqual(0, count($response->result));

    $response = $this->get('social/news', array('from' => $news4->getId()));
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_array($response->result));
      $this->assertEqual(3, count($response->result));
      $this->assertEqual($news3->getId(), $response->result[0]->id);
      $this->assertEqual($news2->getId(), $response->result[1]->id);
      $this->assertEqual($news1->getId(), $response->result[2]->id);
    }

    $response = $this->get('social/news', array(
      'from' => $news4->getId(),
      'to' => $news1->getId(),
    ));
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_array($response->result));
      $this->assertEqual(2, count($response->result));
      $this->assertEqual($news3->getId(), $response->result[0]->id);
      $this->assertEqual($news2->getId(), $response->result[1]->id);
    }

    $response = $this->get('social/news', array(
      'from' => $news4->getId(),
      'to' => $news1->getId(),
      'limit' => 1
    ));
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_array($response->result));
      $this->assertEqual(1, count($response->result));
      $this->assertEqual($news3->getId(), $response->result[0]->id);
    }
  }

  /**
   * example
   * TODO
   */
  function testEmailInvite() {}
}
