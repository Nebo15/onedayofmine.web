<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/service/odExportHelper.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('src/model/User.class.php');
lmb_require('src/model/DayFavorite.class.php');
lmb_require('src/model/News.class.php');
lmb_require('src/model/Complaint.class.php');

class odExportHelperTest extends odUnitTestCase
{
  /**
   * @var odExportHelper
   */
  protected $export_helper;

  /**
   * @var lmbAuditDbConnection
   */
  protected $db_connection;

  function setUp()
  {
    parent::setUp();
    $toolkit = lmbToolkit::instance();

    $this->export_helper = $toolkit->getExportHelper();
    $this->db_connection = $toolkit->wrapDefaultDbConnectionWithProfiler();

    $toolkit->enableDbInfoCache();
    $warmup_cache = $toolkit->getDbInfo($this->db_connection);
  }

  function tearDown()
  {
    lmbToolkit::instance()->disableDbInfoCache();
  }

  function testExportDay_forGuest_withRealImages()
  {
    $day = $this->generator->dayWithMomentsAndComments();

    $this->db_connection->resetStats();
    $exported = $this->export_helper->exportDay($day);
    // $this->assertEqual(13, count($this->db_connection->getQueries()));

    $this->assertJsonDay($exported, true);
  }

  function testExportDay_forUser()
  {
    $this->main_user->save();
    $day = $this->generator->dayWithMomentsAndComments()->save();

    $helper = new odExportHelper($this->main_user);

    $exported = $helper->exportDay($day);
    $this->assertJsonDay($exported, true);
    $this->assertFalse($exported->is_favorite);
    $this->assertFalse($exported->is_liked);

    $this->generator->favorite($day, $this->main_user);
    $this->generator->dayLike($day, $this->main_user);

    $this->db_connection->resetStats();

    $exported = $helper->exportDay($day);
    if($this->assertTrue(property_exists($exported, 'is_favorite')))
      $this->assertTrue($exported->is_favorite);
    if($this->assertTrue(property_exists($exported, 'is_liked')))
      $this->assertTrue($exported->is_liked);
  }

  function testExportDay_forOwner()
  {
    $this->main_user->save();
    $day = $this->generator->dayWithMomentsAndComments($this->main_user);

    $helper = new odExportHelper($this->main_user);

    $exported = $helper->exportDay($day);
    $this->assertJsonDay($exported, true);
    $this->assertFalse($exported->is_deleted);

    $day->is_deleted = 1;
    $day->save();

    $this->db_connection->resetStats();

    $exported = $helper->exportDay($day);
    $this->assertTrue($exported->is_deleted);
  }

  function testExportDayItems_forGuest()
  {
    $days = [];
    foreach(range(0, 10) as $i)
      $days[] = $this->generator->dayWithMomentsAndComments();

    $this->db_connection->resetStats();
    $exported_days = $this->export_helper->exportDayItems($days);
    $this->assertEqual(3, count($this->db_connection->getQueries()));
    foreach($exported_days as $exported_day)
      $this->assertJsonDayListItem($exported_day, true);
  }

  function testExportDayItems_forUser()
  {
    $this->main_user->save();
    $day1 = $this->generator->dayWithMomentsAndComments()->save();
    $day2 = $this->generator->dayWithMomentsAndComments()->save();

    $export_helper = new odExportHelper($this->main_user);

    $exported = $export_helper->exportDayItems([$day1, $day2]);
    $this->assertJsonDayListItem($exported[0], true);
    $this->assertFalse($exported[0]->is_favorite);

    $this->generator->favorite($day1, $this->main_user);

    $this->db_connection->resetStats();

    $exported = $export_helper->exportDayItems([$day1, $day2]);
    $this->assertEqual($day1->id, $exported[0]->id);
    $this->assertTrue($exported[0]->is_favorite);
    $this->assertEqual($day2->id, $exported[1]->id);
    $this->assertFalse($exported[1]->is_favorite);

    $this->assertEqual(4, count($this->db_connection->getQueries()));
  }

  function testExportDayItem_forOwner()
  {
    $this->main_user->save();
    $day1 = $this->generator->dayWithMomentsAndComments($this->main_user)->save();
    $day2 = $this->generator->dayWithMomentsAndComments($this->main_user)->save();

    $export_helper = new odExportHelper($this->main_user);

    $exported = $export_helper->exportDayItems([$day1, $day2]);
    $this->assertJsonDayListItem($exported[0], true);
    $this->assertFalse($exported[0]->is_deleted);

    $day1->is_deleted = 1;
    $day1->save();

    $this->db_connection->resetStats();

    $exported = $export_helper->exportDayItems([$day1, $day2]);
    $this->assertTrue($exported[0]->is_deleted);

    $this->assertEqual(4, count($this->db_connection->getQueries()));
  }

  function testExportDaySubentity()
  {
    $day = $this->generator->dayWithMomentsAndComments($this->main_user);

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportDaySubentity($day);
    $this->assertEqual(1, count($this->db_connection->getQueries()));
    $this->assertJsonDaySubentity($exported, true);
  }

  function testExportUser_forGuest()
  {
    $this->main_user->save();

    $this->db_connection->resetStats();

    $exported = (new odExportHelper())->exportUser($this->main_user);
    $this->assertJsonUser($exported);

    $this->assertEqual(3, count($this->db_connection->getQueries()));
  }

  function testExportUser_forUser()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $export_helper = new odExportHelper($this->additional_user);

    $exported = $export_helper->exportUser($this->main_user);
    $this->assertJsonUser($exported);
    $this->assertFalse($exported->following);

    $this->generator->follow($this->main_user, $this->additional_user);

    $this->db_connection->resetStats();

    $exported = $export_helper->exportUser($this->main_user);
    $this->assertTrue($exported->following);

    $this->assertEqual(3, count($this->db_connection->getQueries()));
  }

  function testExportUser_forOwner()
  {
    $this->main_user->save();

    $export_helper = new odExportHelper($this->main_user);

    $this->db_connection->resetStats();

    $exported = $export_helper->exportUser($this->main_user);
    $this->assertJsonUser($exported);
    $this->assertTrue($exported->email);

    $this->assertEqual(3, count($this->db_connection->getQueries()));
  }

  function testExportUserItems_forGuest()
  {
    $this->main_user->save();

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportUserItems([$this->main_user]);
    $this->assertJsonUserListItem($exported[0]);

    $this->assertEqual(0, count($this->db_connection->getQueries()));
  }

  function testExportUserItems_forUser()
  {
    $current_user = $this->generator->user()->save();
    $user_to_export = $this->generator->user()->save();

    $export_helper = new odExportHelper($current_user);

    $this->db_connection->resetStats();
    $exported = $export_helper->exportUserItem($user_to_export);
    $this->assertJsonUserListItem($exported);
    $this->assertFalse($exported->following);
    $this->assertEqual(1, count($this->db_connection->getQueries()));

    $this->generator->follow($current_user, $user_to_export);

    $this->db_connection->resetStats();
    $exported = $export_helper->exportUserItem($user_to_export);
    $this->assertTrue($exported->following);
    $this->assertEqual(1, count($this->db_connection->getQueries()));
  }

  function testExportUserItem_forOwner()
  {
    $this->main_user->save();
    lmbToolkit::instance()->setUser($this->main_user);

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportUserItem($this->main_user);
    $this->assertJsonUserListItem($exported);

    $this->assertEqual(0, count($this->db_connection->getQueries()));
  }

  function testExportUserSubentity()
  {
    $this->main_user->save();

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportUserSubentity($this->main_user);
    $this->assertJsonUserSubentity($exported);

    $this->assertEqual(0, count($this->db_connection->getQueries()));
  }

  function testExportUserItems()
  {
    $users = [];
    for($i = 0; $i < $this->generator->integer(2); $i++) {
      $user = $this->generator->user();
      $user->save();
      $users[] = $user;
    }

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportUserItems($users);
    $this->assertJsonUserItems($exported);

    $this->assertEqual(0, count($this->db_connection->getQueries()));
  }

  function testExportFacebookUserItems_forGuest()
  {
    $info1 = $this->generator->facebookInfo();
    $info2 = $this->generator->facebookInfo();

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportFacebookUserItems([$info1, $info2]);

    $this->assertEqual(1, count($this->db_connection->getQueries()));

    $this->assertJsonFacebookUserListItem($exported[0]);
    $this->assertJsonFacebookUserListItem($exported[1]);
  }

  function testExportFacebookUserItems_forUser()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $this->generator->follow($this->additional_user, $this->main_user);

    $helper = new odExportHelper($this->main_user);

    $facebook_user = $this->generator->facebookInfo($this->additional_user->facebook_uid);
    $exported = $helper->exportFacebookUserItems([$facebook_user]);
    $this->assertJsonFacebookUserListItem($exported[0]);
    $this->assertTrue($exported[0]->user);
    $this->assertTrue($exported[0]->user->following);
  }

  function testExportMoment()
  {
    $moment = $this->generator->momentWithImage(null, rand(0, 10));
    $moment->save();

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportMoment($moment);
    $this->assertJsonMoment($exported, true);

    $this->assertEqual(2, count($this->db_connection->getQueries()));
  }

  function testExportMomentItems_forGuest()
  {
    $moment3 = $this->generator->momentWithImage();
	  $moment3->time = 3;
	  $moment3->save();
	  $moment1 = $this->generator->momentWithImage();
	  $moment1->time = 1;
	  $moment1->save();
    $moment2 = $this->generator->momentWithImage();
	  $moment2->time = 2;
	  $moment2->save();
	  $shuffled_moments = [$moment3, $moment1, $moment2];

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportMomentItems($shuffled_moments);
    $this->assertJsonMomentItems($exported, true);

		$this->assertEqual($exported[0]->id, $moment1->id);
	  $this->assertEqual($exported[1]->id, $moment2->id);
	  $this->assertEqual($exported[2]->id, $moment3->id);

    $this->assertEqual(2, count($this->db_connection->getQueries()));
  }

  function testExportMomentItems_forUser()
  {
    $moments = [];
    for($i = 0; $i < 10; $i++) {
      $moment = $this->generator->momentWithImage();
      $moment->save();
      for($j = 0; $j < rand(0, 10); $j++) {
        $like = $this->generator->momentLike($moment);
        $like->save();
      }
      $moments[] = $moment;
    }
    $this->generator->momentLike($moments[0], $this->main_user);

    $this->db_connection->resetStats();

    $exported = (new odExportHelper($this->main_user))->exportMomentItems($moments);
    $this->assertJsonMomentItems($exported, true);
    $this->assertTrue($exported[0]->is_liked);
    $this->assertFalse($exported[1]->is_liked);

    $this->assertEqual(2, count($this->db_connection->getQueries()));
  }

  function testExportDayComment()
  {
    $comment = $this->generator->dayComment();
    $comment->save();

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportDayComment($comment);
    $this->assertJsonDayComment($exported);

    $this->assertEqual(1, count($this->db_connection->getQueries()));
  }

  function testExportDayCommentItems()
  {
    $comments = [];
    for($i = 0; $i < $this->generator->integer(2); $i++) {
      $comment = $this->generator->dayComment();
      $comment->save();
      $comments[] = $comment;
    }

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportDayCommentItems($comments);
    $this->assertEqual(1, count($this->db_connection->getQueries()));
    $this->assertJsonDayCommentItems($exported);
  }

  function testExportMomentComment()
  {
    $comment = $this->generator->momentComment();
    $comment->save();

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportMomentComment($comment);
    $this->assertJsonMomentComment($exported);
  }

  function testExportMomentCommentItems()
  {
    $comments = [];
    for($i = 0; $i < $this->generator->integer(2); $i++) {
      $comment = $this->generator->momentComment();
      $comment->save();
      $comments[] = $comment;
    }

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportMomentCommentItems($comments);
    $this->assertEqual(1, count($this->db_connection->getQueries()));
    $this->assertJsonMomentCommentItems($exported);
  }

  function testExportNewsListItem()
  {
    $news = $this->generator->news();
    $news->save();

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportNewsListItem($news);
    $this->assertEqual(1, count($this->db_connection->getQueries()));
    $this->assertJsonNewsListItem($exported);
  }

  function testExportNewsItems()
  {
    $news = [];
    for($i = 0; $i < 5; $i++) {
      $news_item = $this->generator->news();
      $news_item->save();
      $news[] = $news_item;
    }

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportNewsItems($news);
    $this->assertEqual(5, count($this->db_connection->getQueries()));
    $this->assertJsonNewsItems($exported);
  }

  function testExportActivityListItem()
  {
    $news = $this->generator->news();
    $news->save();

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportActivityListItem($news);
    $this->assertJsonActivitiesListItem($exported);

    $this->assertEqual(0, count($this->db_connection->getQueries()));
  }

  function testExportActivityItems()
  {
    $news = [];
    for($i = 0; $i < 5; $i++) {
      $news_item = $this->generator->news();
      $news_item->save();
      $news[] = $news_item;
    }

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportActivityItems($news);
    $this->assertJsonActivitiesList($exported);

    $this->assertEqual(0, count($this->db_connection->getQueries()));
  }

  function testExportComplaint()
  {
    $complaint = $this->generator->complaint();
    $complaint->save();

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportComplaint($complaint);
    $this->assertJsonComplaint($exported);

    $this->assertEqual(0, count($this->db_connection->getQueries()));
  }

  function testExportComplaintItems()
  {
    $complaints = [];
    for($i = 0; $i < 10; $i++) {
      $complaint = $this->generator->complaint();
      $complaint->save();
      $complaints[] = $complaint;
    }

    $this->db_connection->resetStats();

    $exported = $this->export_helper->exportComplaintItems($complaints);
    $this->assertJsonComplaintItems($exported);

    $this->assertEqual(0, count($this->db_connection->getQueries()));
  }
}
