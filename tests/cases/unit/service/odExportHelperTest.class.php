<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/service/odExportHelper.class.php');
lmb_require('src/service/InterestCalculator.class.php');

class odExportHelperTest extends odUnitTestCase
{
  protected $export_helper;

  function setUp()
  {
    parent::setUp();
    $this->export_helper = lmbToolkit::instance()->getExportHelper();
  }

  function testExportDay_forGuest_withRealImages()
  {
    $day = $this->generator->dayWithMomentsAndComments();

    $exported = $this->export_helper->exportDay($day);
    $this->assertJsonDay($exported, true);
  }

  function testExportDay_forUser()
  {
    $day = $this->generator->dayWithMomentsAndComments();

    lmbToolkit::instance()->setUser($this->main_user);

    $exported = $this->export_helper->exportDay($day);
    $this->assertJsonDay($exported, true);
    $this->assertFalse($exported->is_favorite);

    $favorites = $this->main_user->getFavouriteDays();
    $favorites->add($day);
    $this->main_user->save();

    $exported = $this->export_helper->exportDay($day);
    $this->assertTrue($exported->is_favorite);
  }

  function testExportDay_forOwner()
  {
    $day = $this->generator->dayWithMomentsAndComments($this->main_user);

    lmbToolkit::instance()->setUser($this->main_user);

    $exported = $this->export_helper->exportDay($day);
    $this->assertJsonDay($exported, true);
    $this->assertFalse($exported->is_deleted);

    $day->setIsDeleted(1);
    $day->save();

    $exported = $this->export_helper->exportDay($day);
    $this->assertTrue($exported->is_deleted);
  }

  function testExportDayItem_forGuest()
  {
    $day = $this->generator->dayWithMomentsAndComments();

    $exported = $this->export_helper->exportDayItem($day);
    $this->assertJsonDayListItem($exported, true);
  }

  function testExportDayItem_forUser()
  {
    $day = $this->generator->dayWithMomentsAndComments();

    lmbToolkit::instance()->setUser($this->main_user);

    $exported = $this->export_helper->exportDayItem($day);
    $this->assertJsonDayListItem($exported, true);
    $this->assertFalse($exported->is_favorite);

    $favorites = $this->main_user->getFavouriteDays();
    $favorites->add($day);
    $this->main_user->save();

    $exported = $this->export_helper->exportDayItem($day);
    $this->assertTrue($exported->is_favorite);
  }

  function testExportDayItem_forOwner()
  {
    $day = $this->generator->dayWithMomentsAndComments($this->main_user);

    lmbToolkit::instance()->setUser($this->main_user);

    $exported = $this->export_helper->exportDayItem($day);
    $this->assertJsonDayListItem($exported, true);
    $this->assertFalse($exported->is_deleted);

    $day->setIsDeleted(1);
    $day->save();

    $exported = $this->export_helper->exportDayItem($day);
    $this->assertTrue($exported->is_deleted);
  }

  function testExportDaySubentity()
  {
    $day = $this->generator->dayWithMomentsAndComments($this->main_user);

    $exported = $this->export_helper->exportDaySubentity($day);
    $this->assertJsonDaySubentity($exported, true);
  }

  function testExportDayItems()
  {
    $days = [];
    for($i = 0; $i < $this->generator->integer(2); $i++)
      $days[] = $this->generator->dayWithMomentsAndComments();

    $exported = $this->export_helper->exportDayItems($days);
    $this->assertJsonDayItems($exported, true);
  }

  function testExportDayInterestingItems()
  {
    $days = [];
    for($i = 0; $i < $this->generator->integer(2); $i++)
      $days[] = $this->generator->dayWithMomentsAndComments();

    $calc = new InterestCalculator();
    $calc->fillRating();

    $exported = $this->export_helper->exportDayInterestingItems($calc->getDaysRatings());
    $this->assertJsonDayItems($exported, true);
  }

  function testExportUser_forGuest()
  {
    $this->main_user->save();
    $exported = $this->export_helper->exportUser($this->main_user);
    $this->assertJsonUser($exported);
  }

  function testExportUser_forUser()
  {
    lmbToolkit::instance()->setUser($this->additional_user);

    $this->main_user->save();
    $exported = $this->export_helper->exportUser($this->main_user);
    $this->assertJsonUser($exported);
    $this->assertFalse($exported->following);

    $following = $this->main_user->getFollowing();
    $following->add($this->additional_user);
    $following->save();

    $exported = $this->export_helper->exportUser($this->main_user);
    $this->assertTrue($exported->following);
  }

  function testExportUser_forOwner()
  {
    lmbToolkit::instance()->setUser($this->main_user);

    $this->main_user->save();
    $exported = $this->export_helper->exportUser($this->main_user);
    $this->assertJsonUser($exported);
    $this->assertTrue($exported->email);
  }

  function testExportUserItem_forGuest()
  {
    $this->main_user->save();
    $exported = $this->export_helper->exportUserItem($this->main_user);
    $this->assertJsonUserListItem($exported);
  }

  function testExportUserItem_forUser()
  {
    lmbToolkit::instance()->setUser($this->additional_user);

    $this->main_user->save();

    $exported = $this->export_helper->exportUserItem($this->main_user);
    $this->assertJsonUserListItem($exported);
    $this->assertFalse($exported->following);

    $following = $this->main_user->getFollowing();
    $following->add($this->additional_user);
    $following->save();

    $exported = $this->export_helper->exportUserItem($this->main_user);
    $this->assertTrue($exported->following);
  }

  function testExportUserItem_forOwner()
  {
    $this->main_user->save();
    lmbToolkit::instance()->setUser($this->main_user);

    $exported = $this->export_helper->exportUserItem($this->main_user);
    $this->assertJsonUserListItem($exported);
  }

  function testExportUserSubentity()
  {
    $this->main_user->save();
    $exported = $this->export_helper->exportUserSubentity($this->main_user);
    $this->assertJsonUserSubentity($exported);
  }

  function testExportUserItems()
  {
    $users = [];
    for($i = 0; $i < $this->generator->integer(2); $i++) {
      $user = $this->generator->user();
      $user->save();
      $users[] = $user;
    }

    $exported = $this->export_helper->exportUserItems($users);
    $this->assertJsonUserItems($exported);
  }

  function testExportFacebookUserItem_forGuest()
  {
    $exported = $this->export_helper->exportFacebookUserItem($this->generator->facebookInfo());
    $this->assertJsonFacebookUserListItem($exported);
  }

  function testExportFacebookUserItem_forUser()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $following = $this->main_user->getFollowing();
    $following->add($this->additional_user);
    $following->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $exported = $this->export_helper->exportFacebookUserItem($this->generator->facebookInfo($this->additional_user->getFacebookUid()));
    $this->assertJsonFacebookUserListItem($exported);
    $this->assertTrue($exported->user);
    $this->assertTrue($exported->user->following);
  }

  function testExportFacebookUserItems()
  {
    $users = [$this->generator->facebookInfo()];
    for($i = 0; $i < $this->generator->integer(2); $i++) {
      $users[] = $this->generator->facebookInfo();
    }

    $exported = $this->export_helper->exportFacebookUserItems($users);
    $this->assertJsonFacebookUserItems($exported);
  }

  function testExportMoment()
  {
    $moment = $this->generator->momentWithImage();

    $exported = $this->export_helper->exportMoment($moment);
    $this->assertJsonMoment($exported, true);
  }

  function testExportMomentItems()
  {
    $moments = [];
    for($i = 0; $i < $this->generator->integer(2); $i++) {
      $moments[] = $this->generator->momentWithImage();
    }

    $exported = $this->export_helper->exportMomentItems($moments);
    $this->assertJsonMomentItems($exported, true);
  }

  function testExportDayComment()
  {
    $comment = $this->generator->dayComment();
    $comment->save();

    $exported = $this->export_helper->exportDayComment($comment);
    $this->assertJsonDayComment($exported);
  }

  function testExportDayCommentItems()
  {
    $comments = [];
    for($i = 0; $i < $this->generator->integer(2); $i++) {
      $comment = $this->generator->dayComment();
      $comment->save();
      $comments[] = $comment;
    }

    $exported = $this->export_helper->exportDayCommentItems($comments);
    $this->assertJsonDayCommentItems($exported);
  }

  function testExportMomentComment()
  {
    $comment = $this->generator->momentComment();
    $comment->save();

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

    $exported = $this->export_helper->exportMomentCommentItems($comments);
    $this->assertJsonMomentCommentItems($exported);
  }

  function testExportNewsListItem()
  {
    $news = $this->generator->news();
    $news->save();

    $exported = $this->export_helper->exportNewsListItem($news);
    $this->assertJsonNewsListItem($exported);
  }

  function testExportNewsItems()
  {
    $news = [];
    for($i = 0; $i < $this->generator->integer(2); $i++) {
      $news_item = $this->generator->news();
      $news_item->save();
      $news[] = $news_item;
    }

    $exported = $this->export_helper->exportNewsItems($news);
    $this->assertJsonNewsItems($exported);
  }

  function testExportActivityListItem()
  {
    $news = $this->generator->news();
    $news->save();

    $exported = $this->export_helper->exportActivityListItem($news);
    $this->assertJsonNewsListItem($exported);
  }

  function testExportActivityItems()
  {
    $news = [];
    for($i = 0; $i < $this->generator->integer(2); $i++) {
      $news_item = $this->generator->news();
      $news_item->save();
      $news[] = $news_item;
    }

    $exported = $this->export_helper->exportActivityItems($news);
    $this->assertJsonNewsItems($exported);
  }

  function testExportComplaint()
  {
    $complaint = $this->generator->complaint();
    $complaint->save();

    $exported = $this->export_helper->exportComplaint($complaint);
    $this->assertJsonComplaint($exported);
  }

  function testExportComplaintItems()
  {
    $complaints = [];
    for($i = 0; $i < $this->generator->integer(2); $i++) {
      $complaint = $this->generator->complaint();
      $complaint->save();
      $complaints[] = $complaint;
    }

    $exported = $this->export_helper->exportComplaintItems($complaints);
    $this->assertJsonComplaintItems($exported);
  }
}
