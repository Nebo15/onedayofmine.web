<?php
lmb_require('tests/cases/integration/odIntegrationTestCase.class.php');

class UsersControllerIntegrationTest extends odIntegrationTestCase
{

   /**
   * @api
   */
  function testSearch()
  {
    $user1 = $this->generator->user();
    $user1->setName('John Doe');
    $user1->save();
    $user2 = $this->generator->user();
    $user2->setName('John Watson');
    $user2->save();
    $user3 = $this->generator->user();
    $user3->setName('Johnnie Cheeze');
    $user3->save();
    $user4 = $this->generator->user();
    $user4->setName('John John');
    $user4->save();
    $user5 = $this->generator->user();
    $user5->setName('Mike Jameson');
    $user5->save();

    $sphinx_config = lmbToolkit::instance()->getConf('sphinx');
    lmb_assert_true(array_key_exists('config_file_path', $sphinx_config), 'Sphinx config file not set. Check config.');
    lmb_assert_true($sphinx_config['config_file_path'], 'Sphinx config file path is emprty. Check config.');
    lmb_assert_true(file_exists($sphinx_config['config_file_path']), "Sphinx config file '{$sphinx_config['config_file_path']}' not found. Check config.");
    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate users --quiet"))
    {
      echo "indexer --config {$sphinx_config['config_file_path']} --rotate users --quiet";
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }
    sleep(1);

    $response = $this->get('users/search', [
      'query' => 'John*'
    ]);
    if($this->assertResponse(200))
    {
      $response_users = $response->result;
      $this->assertEqual(4, count($response_users));
      $this->assertJsonUserItems($response_users);

      $this->assertEqual($user1->getId(), $response_users[0]->id);
      $this->assertEqual($user2->getId(), $response_users[1]->id);
      $this->assertEqual($user3->getId(), $response_users[2]->id);
      $this->assertEqual($user4->getId(), $response_users[3]->id);
    }

    $response_with_from = $this->get('users/search', [
      'query' => 'John*',
      'from'  => $user1->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $response_users = $response_with_from->result;
      $this->assertEqual(3, count($response_users));
      $this->assertJsonUserItems($response_users);

      $this->assertEqual($user2->getId(), $response_users[0]->id);
      $this->assertEqual($user3->getId(), $response_users[1]->id);
      $this->assertEqual($user4->getId(), $response_users[2]->id);
    }

    $response_with_range = $this->get('users/search', [
      'query' => 'John*',
      'from'  => $user1->getId(),
      'to'    => $user4->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $response_users = $response_with_range->result;
      $this->assertEqual(2, count($response_users));
      $this->assertJsonUserItems($response_users);

      $this->assertEqual($user2->getId(), $response_users[0]->id);
      $this->assertEqual($user3->getId(), $response_users[1]->id);
    }

    $response_with_limit = $this->get('users/search', [
      'query' => 'John*',
      'from'  => $user1->getId(),
      'to'    => $user4->getId(),
      'limit' => 1,
    ]);
    if($this->assertResponse(200))
    {
      $response_users = $response_with_limit->result;
      $this->assertEqual(1, count($response_users));
      $this->assertJsonUserItems($response_users);

      $this->assertEqual($user2->getId(), $response_users[0]->id);
    }

    $empty_response = $this->get('users/search', [
      'query' => 'James'
    ]);
    if($this->assertResponse(200))
    {
      $response_users = $empty_response->result;
      $this->assertEqual(0, count($response_users));
    }

    $response_wtihout_star = $this->get('users/search', [
      'query' => 'James*'
    ]);
    if($this->assertResponse(200))
    {
      $response_users = $response_wtihout_star->result;
      $this->assertEqual(1, count($response_users));
      $this->assertJsonUserItems($response_users);
    }
  }

  function testSearch_IndexUpdatedFromDeltaIndex()
  {
    $sphinx_config = lmbToolkit::instance()->getConf('sphinx');
    lmb_assert_true(array_key_exists('config_file_path', $sphinx_config), 'Sphinx config file not set. Check config.');
    lmb_assert_true($sphinx_config['config_file_path'], 'Sphinx config file path is emprty. Check config.');
    lmb_assert_true(file_exists($sphinx_config['config_file_path']), "Sphinx config file '{$sphinx_config['config_file_path']}' not found. Check config.");

    $user1 = $this->generator->user();
    $user1->setName('John Doe');
    $user1->save();

    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate users --quiet"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }
    sleep(1);

    $response = $this->get('users/search', [
      'query' => 'John*'
    ]);
    if($this->assertResponse(200))
    {
      $this->assertEqual(1, count($response->result));
      $this->assertJsonUserItems($response->result);
    }

    $user2 = $this->generator->user();
    $user2->setName('John Watson');
    $user2->save();

    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate users_delta --quiet"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }
    sleep(1);

    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate --quiet --merge users users_delta"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }
    sleep(1);

    $response = $this->get('users/search', [
      'query' => 'John*'
    ]);
    if($this->assertResponse(200))
    {
      $this->assertEqual(2, count($response->result));
      $this->assertJsonUserItems($response->result);
    }

    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate users_delta --quiet"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }

    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate --quiet --merge users users_delta"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }

    $response = $this->get('users/search', [
      'query' => 'John*'
    ]);
    if($this->assertResponse(200))
    {
      $this->assertEqual(2, count($response->result));
      $this->assertJsonUserItems($response->result);
    }
  }
}
