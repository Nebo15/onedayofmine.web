<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/model/User.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/News.class.php');

class RelationsTest extends odUnitTestCase
{
  function testUserToDayRelation()
  {
    $user = $this->generator->user();
    $day1 = $this->generator->day($user);
    $day2 = $this->generator->day($user);
    $day3 = $this->generator->day();

    $loaded_user = User::findById($user->id);
    $this->assertEqual(2, $loaded_user->getDays()->count());
    $this->assertEqual($loaded_user->getDays()[0]->id, $day2->id);

    $loaded_day1 = Day::findById($day1->id);
    $this->assertEqual($loaded_day1->user_id, $user->id);
  }

  function testUserToDaysCommentsRelations()
  {
    $user = $this->generator->user();

    $comment = $this->generator->dayComment(null, $user);

    /** @var $loaded_user User */
    $loaded_user = User::findById($user->id);
    $this->assertEqual($loaded_user->getDaysComments()->at(0)->id, $comment->id);

    $loaded_comment = DayComment::findById($comment->id);
    $this->assertEqual($loaded_comment->user_id, $user->id);
  }

  function testUserToMomentsCommentsRelations()
  {
    $user = $this->generator->user();
    $user->save();

    $comment = $this->generator->momentComment(null, $user);
    $comment->save();

    /** @var $loaded_user User */
    $loaded_user = User::findById($user->id);
    $this->assertEqual($loaded_user->getMomentsComments()->at(0)->id, $comment->id);

    $loaded_comment = MomentComment::findById($comment->id);
    $this->assertEqual($loaded_comment->user_id, $user->id);
  }

  function testDayToMomentsRelations()
  {
    $day = $this->generator->day();
    $day->save();

    $moment1 = $this->generator->moment($day);
    $moment1->save();

    $moment2 = $this->generator->moment($day);
    $moment2->save();

    $moment3 = $this->generator->moment();
    $moment3->save();

    /** @var $loaded_day Day */
    $loaded_day = Day::findById($day->id);
    $this->assertEqual(2, $loaded_day->getMoments()->count());
    $this->assertEqual($moment1->id, $loaded_day->getMoments()->at(0)->id);

    $loaded_moment = Moment::findById($moment1->id);
    $this->assertEqual($day->id, $loaded_moment->day_id);
  }

  function testUserWithNewsRelations()
  {
    // With is used because im testing relation in both sides
    $creator = $this->generator->user();
    $creator->save();

    $recipient = $this->generator->user();
    $recipient->save();

    $news = $this->generator->news($creator, $recipient);
    $news->save();

    // User to News
    $this->assertEqual(count($recipient->getNews()), 1);
    $this->assertEqual(count($creator->getCreatedNews()), 1);
    $this->assertEqual($creator->getCreatedNews()->at(0)->id, $news->id);
    $this->assertEqual($creator->getCreatedNews()->at(0)->id, $recipient->getNews()->at(0)->id);

    // News to User
    $this->assertEqual($news->getRecipients()->at(0)->id, $recipient->id);
  }

  function testNewsToDayRelations()
  {
    $day = $this->generator->day();
    $day->save();

    $news = $this->generator->news();
    $news->setDay($day);
    $news->save();

    $this->assertEqual($news->day_id, $day->id);
  }

  function testNewsToMomentRelations()
  {
    $day = $this->generator->day();
    $moment = $this->generator->moment();
    $news = $this->generator->news();
    //$news->setDay($day);
    $news->setMoment($moment);

    $this->assertEqual($news->moment_id, $moment->id);
  }
}
