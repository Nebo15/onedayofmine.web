<?php
lmb_require('tests/cases/integration/odIntegrationTestCase.class.php');

class DaysGuestControllerIntegrationTest extends odIntegrationTestCase
{

  /**
   * @api
   */
  function testSearch()
  {
    $sphinx_config = lmbToolkit::instance()->getConf('sphinx');
    lmb_assert_true(array_key_exists('config_file_path', $sphinx_config), 'Sphinx config file not set. Check config.');
    lmb_assert_true($sphinx_config['config_file_path'], 'Sphinx config file path is emprty. Check config.');
    lmb_assert_true(file_exists($sphinx_config['config_file_path']), "Sphinx config file '{$sphinx_config['config_file_path']}' not found. Check config.");

    $day1 = $this->generator->dayWithMoments(null, 'My insane day');
    $day1->save();
    $day2 = $this->generator->dayWithMoments(null, 'Weird weekend');
    $day2->setFinalDescription('Insanely comments here');
    $day2->save();
    $day3 = $this->generator->dayWithMoments(null, 'Insane insane day');
    $day3->save();
    $day4 = $this->generator->dayWithMoments(null, 'Paranormal day');
    $moment = $this->generator->momentWithImage($day4);
    $moment->setDescription('Insane photo');
    $moment->save();
    $day4->save();
    $day5 = $this->generator->dayWithMoments(null, 'Something unusual');
    $day5->save();
    $day6 = $this->generator->dayWithMoments(null, 'Insane insenity');
    $day6->setIsDeleted(1);
    $day6->save();

    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate days --quiet"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }
    sleep(1);

    $response = $this->get('days/search', [
      'query' => 'Insane'
    ]);
    if($this->assertResponse(200))
    {
      $days = $response->result;
      $this->assertEqual(4, count($days));
      $this->assertJsonDayItems($days);

      $this->assertEqual($day1->getId(), $days[0]->id);
      $this->assertEqual($day3->getId(), $days[1]->id);
      $this->assertEqual($day2->getId(), $days[2]->id);
      $this->assertEqual($day4->getId(), $days[3]->id);
    }

    $response_with_from = $this->get('days/search', [
      'query' => 'Insane',
      'from'  => $day1->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_from->result;
      $this->assertEqual(3, count($days));
      $this->assertJsonDayItems($days);

      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertEqual($day4->getId(), $days[2]->id);
    }

    $response_with_range = $this->get('days/search', [
      'query' => 'Insane',
      'from'  => $day1->getId(),
      'to'    => $day4->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_range->result;
      $this->assertEqual(2, count($days));
      $this->assertJsonDayItems($days);

      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
    }

    $response_with_limit = $this->get('days/search', [
      'query' => 'Insane',
      'from'  => $day1->getId(),
      'to'    => $day4->getId(),
      'limit' => 1,
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_limit->result;
      $this->assertEqual(1, count($days));
      $this->assertJsonDayItems($days);

      $this->assertEqual($day3->getId(), $days[0]->id);
    }
  }

  function testSearch_IndexUpdatedFromDeltaIndex()
  {
    $sphinx_config = lmbToolkit::instance()->getConf('sphinx');
    lmb_assert_true(array_key_exists('config_file_path', $sphinx_config), 'Sphinx config file not set. Check config.');
    lmb_assert_true($sphinx_config['config_file_path'], 'Sphinx config file path is emprty. Check config.');
    lmb_assert_true(file_exists($sphinx_config['config_file_path']), "Sphinx config file '{$sphinx_config['config_file_path']}' not found. Check config.");

    $day1 = $this->generator->dayWithMoments(null, 'My insane day');
    $day1->save();

    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate days --quiet"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }
    sleep(1);

    $response = $this->get('days/search', [
      'query' => 'insane'
    ]);
    if($this->assertResponse(200))
    {
      $this->assertEqual(1, count($response->result));
      $this->assertJsonDayItems($response->result);
    }

    $day2 = $this->generator->dayWithMoments(null, 'Weird weekend');
    $day2->setFinalDescription('Insanely comments here');
    $day2->save();

    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate days_delta --quiet"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }
    sleep(1);

    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate --quiet --merge days days_delta"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }
    sleep(1);

    $response = $this->get('days/search', [
      'query' => 'insane'
    ]);
    if($this->assertResponse(200))
    {
      $this->assertEqual(2, count($response->result));
      $this->assertJsonDayItems($response->result);
    }

    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate days_delta --quiet"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }

    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate --quiet --merge days days_delta"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }

    $response = $this->get('days/search', [
      'query' => 'insane'
    ]);
    if($this->assertResponse(200))
    {
      $this->assertEqual(2, count($response->result));
      $this->assertJsonDayItems($response->result);
    }
  }
}
