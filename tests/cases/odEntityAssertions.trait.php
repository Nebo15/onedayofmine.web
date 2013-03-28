<?php
trait odEntityAssertions
{
  protected function assertResponseClass(stdClass $response, $message = "Wrong response structure")
  {
    $this->assertPropertys($response, [
      'result',
      'errors',
      'status',
      'code',
    ], $message);
  }

  protected function assertProperty($obj, $property, $message = "Property '%s' not found")
  {
    if(!is_object($obj))
      return $this->fail("Expected a object but '".gettype($obj)."' given");

    return $this->assertTrue(
      property_exists($obj, $property),
      sprintf($message, $property)
    );
  }

  protected function assertPropertys(stdClass $obj, array $propertys, $message = "Property '%s' not found")
  {
    foreach ($propertys as $property)
    {
      $this->assertProperty($obj, $property, $message);
    }
  }

  public function assertEqualPropertyValues(stdClass $main_object, stdClass $updated_object, $verbose = false)
  {
    foreach ($main_object as $key => $value)
    {
      if(property_exists($updated_object, $key))
        $this->assertEqual($main_object->$key, $value);
      elseif($verbose)
        $this->fail("Property '$key' not found");
    }
  }

  protected function assert404Url($url)
  {
    return $this->assertFalse($this->_isUrlExists($url), "Image exists '{$url}'");
  }

  protected function _isUrlExists($url)
  {
    $images_conf = lmbToolkit::instance()->getConf('images');
    $uri = new lmbUri($url);
    $abs_path = lmb_env_get('APP_DIR').'/'.$images_conf['save_path'].'/'.$uri->getPath();
    return file_exists($abs_path);
  }

  protected function assertImageUrl($url, $message = "Invalid image url '%s'")
  {
    return $this->assertTrue($this->_isUrlExists($url), sprintf($message, $url));
  }

  protected function assertImageUrls(array $urls)
  {
    foreach ($urls as $url)
    {
      $this->assertImageUrl($url);
    }
  }

  ########### User ###########
  protected function assertJsonUser(stdClass $user)
  {
    $this->assertJsonUserSubentity($user);

    $this->assertPropertys($user, [
      "birthday",
      "followers_count",
      "following_count",
      "favorites_count",
      "days_count",
    ]);

    $this->assertTrue($user->birthday, "Birthday can't be empty");
    $this->assertFalse(is_null($user->followers_count), "Followers count can't be null");
    $this->assertFalse(is_null($user->following_count), "Following count can't be null");
    $this->assertFalse(is_null($user->favorites_count), "Favorites count can't be null");
    $this->assertFalse(is_null($user->days_count), "Days count can't be null");

    if(lmbToolkit::instance()->getUser())
    {
      if(lmbToolkit::instance()->getUser()->id == $user->id)
        $this->assertProperty($user, 'email');
      else
        $this->assertProperty($user, 'following');
    }
  }

  protected function assertJsonUserListItem(stdClass $user)
  {
    $this->assertJsonUserSubentity($user);

    if(lmbToolkit::instance()->getUser() && lmbToolkit::instance()->getUser()->id != $user->id)
    {
      $this->assertProperty($user, 'following');
    }
  }

  protected function assertJsonUserSubentity(stdClass $user)
  {
    $this->assertPropertys($user, [
      "id",
      "name",
      "sex",
      "image_36",
      "image_72",
      "image_96",
      "image_192",
      "occupation",
      "location",
    ]);

    $this->assertTrue($user->id, "User ID not set");
    $this->assertTrue($user->name, "User name can't be empty");

    $this->assertTrue($user->sex, 'User gender is not set');
    $this->assertTrue(false !== array_search($user->sex, [
      'male',
      'female',
    ]), "Uknown user gender '{$user->sex}'");

    $this->assertImageUrls([
      $user->image_36,
      $user->image_72,
      $user->image_96,
      $user->image_192,
    ]);
  }

  protected function assertJsonUserItems(array $users)
  {
    foreach ($users as $user)
    {
      $this->assertJsonUserListItem($user);
    }
  }

  ########### > FacebookUser ###########
  protected function assertJsonFacebookUserListItem(stdClass $facebook_user, $validate_images = false)
  {
    $this->assertPropertys($facebook_user, [
      "uid",
      "name",
      "image_50",
      "image_150",
      "user",
    ]);

    $this->assertTrue($facebook_user->uid, "User ID not set");
    $this->assertTrue($facebook_user->name, "User name can't be empty");

    if($validate_images)
      $this->assertImageUrls([
        $facebook_user->image_50,
        $facebook_user->image_150,
      ]);
    else
    {
      $this->assertTrue($facebook_user->image_50);
      $this->assertTrue($facebook_user->image_150);
    }

    if(!is_null($facebook_user->user))
      $this->assertJsonUserSubentity($facebook_user->user);
  }

  protected function assertJsonFacebookUserItems(array $facebook_users, $validate_images = false)
  {
    foreach ($facebook_users as $facebook_user)
    {
      $this->assertJsonFacebookUserListItem($facebook_user, $validate_images);
    }
  }

  ########### > Settings ###########
  protected function assertJsonUserSettings(stdClass $settings)
  {
    $this->assertPropertys($settings, [
      "notifications_new_days",
      "notifications_new_comments",
      "notifications_new_replays",
      "notifications_related_activity",
      "notifications_shooting_photos",
      "photos_save_original",
      "photos_save_filtered",
      "social_share_facebook",
      "social_share_twitter",
    ]);

    $this->assertTrue('notifications_new_days');
    $this->assertTrue('notifications_new_comments');
    $this->assertTrue('notifications_new_replays');
    $this->assertTrue('notifications_related_activity');
    $this->assertTrue('notifications_shooting_photos');
    $this->assertTrue('photos_save_original');
    $this->assertTrue('photos_save_filtered');
    $this->assertTrue('social_share_facebook');
    $this->assertTrue('social_share_twitter');
  }

  ########### Day ###########
  protected function assertJsonDay(stdClass $day, $validate_images = false, $message = '%s')
  {
    $this->assertJsonDayListItem($day, $validate_images);

    $this->assertProperty($day, "final_description");

    if($day->comments_count > 0)
    {
      $this->assertTrue(
        count($day->comments) <= lmbToolkit::instance()->getConf('common')->default_comments_count,
        'Expected max ' . lmbToolkit::instance()->getConf('common')->default_comments_count . ' preloaded comments, got ' . count($day->comments)
      );

      $this->assertJsonDayCommentItems($day->comments);
    }
    else
      $this->assertEqual(count($day->comments), 0, 'Comments count equals zero, when '.count($day->comments).' comments returned');

    if(count($day->moments) > 0)
      $this->assertJsonMomentItems($day->moments);
  }

  protected function assertJsonDayListItem(stdClass $day, $validate_images = false, $message = '%s')
  {
    $this->assertJsonDaySubentity($day, $validate_images);

    $this->assertPropertys($day, [
      "likes_count",
      "comments_count",
      "views_count",
    ]);

    if(lmbToolkit::instance()->getUser())
    {
      if(lmbToolkit::instance()->getUser()->id == $day->user->id)
        $this->assertProperty($day, 'is_deleted');

      $this->assertProperty($day, 'is_favorite');
    }

    $this->assertFalse(is_null($day->likes_count), "Likes count can't be null");
    $this->assertFalse(is_null($day->comments_count), "Comments count can't be null");
    $this->assertFalse(is_null($day->views_count), "Views count can't be null");
  }

  protected function assertJsonDaySubentity(stdClass $day, $validate_images = false, $message = '%s')
  {
    $this->assertPropertys($day, [
      "id",
      "user",
      "image_266",
      "image_532",
      "title",
      "type",
    ]);

    $this->assertTrue($day->id, 'Day ID not set');

    $this->assertTrue($day->user);
    $this->assertJsonUserSubentity($day->user);

    if($validate_images)
      $this->assertImageUrls([
        $day->image_266,
        $day->image_532,
      ]);

    $this->assertTrue($day->title);

    $this->assertTrue($day->type, 'Day type is not set');
    $this->assertTrue(false !== array_search($day->type, [
      'Working day',
      'Day off',
      'Holiday',
      'Trip',
      'Special event',
    ]), "Uknown day type '{$day->type}'");
  }

  protected function assertJsonDayItems(array $days, $validate_images = false)
  {
    foreach ($days as $day)
    {
      $this->assertJsonDayListItem($day, $validate_images);
    }
  }

  ########### Moment ###########
  protected function assertJsonMoment(stdClass $moment, $validate_images = false)
  {
    $this->assertJsonMomentListItem($moment, $validate_images);
  }

  protected function assertJsonMomentListItem(stdClass $moment, $validate_images = false)
  {
    $this->assertJsonMomentSubentity($moment, $validate_images);
  }

  protected function assertJsonMomentSubentity(stdClass $moment, $validate_images = false)
  {
    $this->assertPropertys($moment, [
      "id",
      "time",
      "image_266",
      "image_532",
      "likes_count",
      "comments_count",
    ]);

    $this->assertTrue($moment->id, 'Moment ID not set');
    $this->assertTrue($moment->time);

    if($validate_images)
      $this->assertImageUrls([
        $moment->image_266,
        $moment->image_532,
      ]);

    $this->assertFalse(is_null($moment->likes_count), "Likes count can't be null");
    $this->assertFalse(is_null($moment->comments_count), "Comments count can't be null");
  }

  protected function assertJsonMomentItems(array $moments, $validate_images = false)
  {
    foreach ($moments as $moment)
    {
      $this->assertJsonMomentListItem($moment, $validate_images);
    }
  }

  ########### DayComment ###########
  protected function assertJsonDayComment(stdClass $comment)
  {
    $this->assertJsonDayCommentSubentity($comment);
  }

  protected function assertJsonDayCommentListItem(stdClass $comment)
  {
    $this->assertJsonDayCommentSubentity($comment);
  }

  protected function assertJsonDayCommentSubentity(stdClass $comment)
  {
    $this->assertPropertys($comment, [
      "id",
      "user",
      "text",
    ]);

    $this->assertTrue($comment->id, 'Day comment ID not set');
    $this->assertTrue($comment->user);
    $this->assertJsonUserSubentity($comment->user);
    $this->assertTrue($comment->text);
  }

  protected function assertJsonDayCommentItems(array $comments)
  {
    foreach ($comments as $comment)
    {
      $this->assertJsonDayCommentListItem($comment);
    }
  }

  ########### MomentComment ###########
  protected function assertJsonMomentComment(stdClass $comment)
  {
    $this->assertJsonMomentCommentSubentity($comment);
  }

  protected function assertJsonMomentCommentListItem(stdClass $comment)
  {
    $this->assertJsonMomentCommentSubentity($comment);
  }

  protected function assertJsonMomentCommentSubentity(stdClass $comment)
  {
    $this->assertPropertys($comment, [
      "id",
      "user",
      "text",
    ]);

    $this->assertTrue($comment->id, 'Moment comment ID not set');
    $this->assertTrue($comment->user);
    $this->assertJsonUserSubentity($comment->user);
    $this->assertTrue($comment->text);
  }

  protected function assertJsonMomentCommentItems(array $comments)
  {
    foreach ($comments as $comment)
    {
      $this->assertJsonMomentCommentListItem($comment);
    }
  }

  ############ Complaint ###########
  protected function assertJsonComplaint(stdClass $complaint)
  {
    $this->assertJsonComplaintSubentity($complaint);
  }

  protected function assertJsonComplaintListItem(stdClass $complaint)
  {
    $this->assertJsonComplaintSubentity($complaint);
  }

  protected function assertJsonComplaintSubentity(stdClass $complaint)
  {
    $this->assertPropertys($complaint, [
      "id",
      "day_id",
      "text",
    ]);

    $this->assertTrue($complaint->id, 'Complaint ID not set');
    $this->assertTrue($complaint->day_id);
    $this->assertTrue($complaint->text);
  }

  protected function assertJsonComplaintItems(array $complaints)
  {
    foreach ($complaints as $complaint)
    {
      $this->assertJsonComplaintListItem($complaint);
    }
  }

  ############ News ###########
  protected function assertJsonNews(stdClass $news)
  {
    $this->assertJsonNewsSubentity($news);
  }

  protected function assertJsonNewsListItem(stdClass $news)
  {
    $this->assertJsonNewsSubentity($news);
  }

  protected function assertJsonNewsSubentity(stdClass $news)
  {
    $this->assertPropertys($news, [
      "id",
      "time",
      "text",
      "link",
      "sender"
    ]);

    $this->assertTrue($news->id, 'News ID not set');
    $this->assertTrue($news->time);
    $this->assertTrue($news->text);
    $this->assertTrue($news->link);
  }

  protected function assertJsonNewsItems(array $news)
  {
    foreach ($news as $news_item)
    {
      $this->assertJsonNewsListItem($news_item);
    }
  }

  protected function assertJsonActivitiesListItem(stdClass $activitity)
  {
    $this->assertPropertys($activitity, ["id", "time", "text", "link"]);

    $this->assertTrue($activitity->id, 'News ID not set');
    $this->assertTrue($activitity->time);
    $this->assertTrue($activitity->text);
    $this->assertTrue($activitity->link);
  }

  protected function assertJsonActivitiesList(array $news)
  {
    foreach ($news as $news_item)
    {
      $this->assertJsonActivitiesListItem($news_item);
    }
  }
}
