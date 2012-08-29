<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');

class RelationsTest extends odUnitTestCase
{

  function testUserToDayRelation()
  {
    $user = $this->generator->user();
    $user->save();

    $day1 = $this->generator->day($user);
    $day1->save();

    $day2 = $this->generator->day($user);
    $day2->save();

    $day3 = $this->generator->day();
    $day3->save();

    $loaded_user = User::findById($user->getId());
    $this->assertEqual(2, $loaded_user->getDays()->count());
    $this->assertEqual($loaded_user->getDays()->at(0)->getId(), $day2->getId());

    $loaded_day1 = Day::findById($day1->getId());
    $this->assertEqual($loaded_day1->getUser()->getId(), $user->getId());
  }

  function testUserToDaysCommentsRelations()
  {
    $user = $this->generator->user();
    $user->save();

    $comment = $this->generator->dayComment(null, $user);
    $comment->save();

    $loaded_user = User::findById($user->getId());
    $this->assertEqual($loaded_user->getDaysComments()->at(0)->getId(), $comment->getId());

    $loaded_comment = DayComment::findById($comment->getId());
    $this->assertEqual($loaded_comment->getUser()->getId(), $user->getId());
  }

  function testUserToMomentsCommentsRelations()
  {
    $user = $this->generator->user();
    $user->save();

    $comment = $this->generator->momentComment(null, $user);
    $comment->save();

    $loaded_user = User::findById($user->getId());
    $this->assertEqual($loaded_user->getMomentsComments()->at(0)->getId(), $comment->getId());

    $loaded_comment = MomentComment::findById($comment->getId());
    $this->assertEqual($loaded_comment->getUser()->getId(), $user->getId());
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

    $loaded_day = Day::findById($day->getId());
    $this->assertEqual(2, $loaded_day->getMoments()->count());
    $this->assertEqual($moment1->getId(), $loaded_day->getMoments()->at(0)->getId());

    $loaded_moment = Moment::findById($moment1->getId());
    $this->assertEqual($day->getId(), $loaded_moment->getDay()->getId());
  }

  function testUserWithNewsRelations() { // With is used because im testing relation in both sides
    $creator = $this->generator->user();
    $creator->save();

    $recipient = $this->generator->user();
    $recipient->save();

    $news = $this->generator->news($creator, $recipient);
    $news->save();

    // User to News
    $this->assertEqual(count($recipient->getNews()), 1);
    $this->assertEqual(count($creator->getCreatedNews()), 1);
    $this->assertEqual($creator->getCreatedNews()->at(0)->getId(), $news->getId());
    $this->assertEqual($creator->getCreatedNews()->at(0)->getId(), $recipient->getNews()->at(0)->getId());

    // News to User
    $this->assertEqual($news->getRecipient()->getId(), $recipient->getId());
  }

  function testNewsToDayRelations() {
    $day = $this->generator->day();
    $day->save();

    $news = $this->generator->news();
    $news->setDay($day);
    $news->save();

    $this->assertEqual($news->getDay()->getId(), $day->getId());
  }

  function testNewsToMomentRelations() {
    $day = $this->generator->day();
    $day->save();

    $moment = $this->generator->moment();
    $moment->save();

    $news = $this->generator->news();
    //$news->setDay($day);
    $news->setMoment($moment);
    $news->save();

    $this->assertEqual($news->getMoment()->getId(), $moment->getId());
  }
}
