<?php
lmb_require('src/model/User.class.php');
lmb_require('src/model/DayJournalRecord.class.php');

class odExportHelper
{
  protected $current_user;

  function __construct(User $current_user = null)
  {
    $this->current_user = $current_user;
  }

  ############### Day ###############
  function exportDay(Day $day)
  {
    $exported_day = $this->exportDayItems([$day])[0];
	  $exported_day->is_gathering_enabled = false;

    $is_owner = $this->current_user && $this->current_user->id && $this->current_user->id == $day->user_id;

	  $moments = $is_owner ? $day->getAllMoments() : $day->getMoments();
    $exported_day->moments  = $this->exportMomentItems($moments);

    $comments = $day->getComments();
    $comments->paginate(0, lmbToolkit::instance()->getConf('common')->default_comments_count);
    $exported_day->comments = $this->exportDayCommentItems($comments);

    $likes = $day->getLikes();
    $likes->paginate(0, lmbToolkit::instance()->getConf('common')->default_likes_count);
    $exported_day->likes = $this->exportDayLikeItems($likes);

    $exported_day->final_description = $day->final_description;

    if($this->current_user && !$is_owner)
    {
      $liked_day = lmbDBAL::selectQuery('day_like')
        ->addField('day_id')
        ->addField('user_id')
        ->addCriteria(lmbSQLCriteria::equal('user_id', $this->current_user->id))
        ->addCriteria(lmbSQLCriteria::equal('day_id', $day->id))
        ->fetch()->toFlatArray();
      $liked_day = lmbArrayHelper::getColumnValues('day_id', $liked_day);
      $exported_day->is_liked = in_array($day->id, $liked_day);

	    if($day->is_gathering_enabled)
	      if(UserFollowing::isUserFollowUser($day->user_id, $this->current_user))
		      $exported_day->is_gathering_enabled = true;
    }

	  if($is_owner)
	  {
		  $exported_day->is_gathering_enabled = $day->is_gathering_enabled;
	  }

    return $exported_day;
  }

  function exportDaySubentity(Day $day)
  {
    $exported = $day->exportForApi();
    unset($exported->final_description);

    $this->attachUserSubentityToExport($day->getUser(), $exported);

    return $exported;
  }

  function exportDayItems($days)
  {
    if(is_object($days))
      $days = $days->getArray();

    foreach($days as $key => $day)
    {
      if(!$day->is_deleted)
        continue;
      if($this->current_user && $this->current_user->id == $day->user_id)
        continue;
      unset($days[$key]);
    }

    if(!count($days))
      return [];

    $days_ids = lmbArrayHelper::getColumnValues('id', $days);

    $likes_count = lmbDBAL::selectQuery('day_like')
      ->addField('day_id')
      ->addRawField('COUNT(id)', 'count')
      ->addGroupBy('day_id')
      ->addCriteria(lmbSQLCriteria::in('day_id', $days_ids))
      ->fetch()->toFlatArray();
    $likes_count = lmbArrayHelper::makeKeysFromColumnValues('day_id', $likes_count);

	  $days_times = lmbDBAL::selectQuery('moment')
			  ->addField('day_id')
			  ->addField('time')
			  ->addGroupBy('day_id')
			  ->addCriteria(lmbSQLCriteria::in('day_id', $days_ids))
			  ->addCriteria(lmbSQLCriteria::equal('position', '0'))
			  ->fetch()->toFlatArray();
	  $days_times = lmbArrayHelper::makeKeysFromColumnValues('day_id', $days_times);

    $comments_count = lmbDBAL::selectQuery('day_comment')
      ->addField('day_id')
      ->addRawField('COUNT(id)', 'count')
      ->addGroupBy('day_id')
      ->addCriteria(lmbSQLCriteria::in('day_id', $days_ids))
      ->fetch()->toFlatArray();
    $comments_count = lmbArrayHelper::makeKeysFromColumnValues('day_id', $comments_count);

    $day_users_ids = lmbArrayHelper::getColumnValues('user_id', $days);
    $day_users = User::findByIds($day_users_ids);
    $day_users = lmbArrayHelper::makeKeysFromColumnValues('id', $day_users);

	  $days_in_journal = DayJournalRecord::findByDayId($days_ids);
	  $days_in_journal_ids = lmbArrayHelper::getColumnValues('day_id', $days_in_journal);

    if($this->current_user)
    {
      lmb_assert_true($this->current_user->id);
      $favorite_days_ids = lmbDBAL::selectQuery('day_favorite')
        ->addField('day_id')
        ->addCriteria(lmbSQLCriteria::equal('user_id', $this->current_user->id))
        ->fetch()->toFlatArray();
      $favorite_days_ids = lmbArrayHelper::getColumnValues('day_id', $favorite_days_ids);
    }

    $exported = [];
    foreach ($days as $day)
    {
      $is_day_in_journal = in_array($day->id, $days_in_journal_ids);
	    $current_user_is_editor = $this->current_user && $this->current_user->is_editor;
	    $owner_is_editor = $day_users[$day->user_id]->is_editor;

	    $exported_day = $day->exportForApi();
	    if(!$is_day_in_journal || $current_user_is_editor || !$owner_is_editor)
        $exported_day->user = $day_users[$day->user_id]->exportForApi();
      unset($exported_day->user_id);

      if($this->current_user)
      {
        $exported_day->is_favorite = in_array($day->id, $favorite_days_ids);

        if($this->current_user->id == $day->user_id)
          $exported_day->is_deleted = (bool) $day->is_deleted;
      }

      $exported_day->likes_count =
        isset($likes_count[$day->id]) ? $likes_count[$day->id]['count'] : 0;
      $exported_day->comments_count =
        isset($comments_count[$day->id]) ? $comments_count[$day->id]['count'] : 0;
	    $exported_day->datetime =
			    isset($days_times[$day->id]) ? (int) $days_times[$day->id]['time'] : 0;

      $exported[] = $exported_day;
    }

    return $exported;
  }

  ############### User ###############
  function exportUser(User $user)
  {
    $exported = $user->exportForApi();

    $exported->days_count = (int) $user->getPublicDays()->count();

    $favorite_days_count = lmbDBAL::selectQuery('day_favorite')
      ->addRawField('COUNT(*)', 'count')
      ->addCriteria(lmbSQLCriteria::equal('user_id', $user->id))
      ->fetch()->toFlatArray();

    $exported->favorites_count = (int) $favorite_days_count[0]['count'];

    $following_and_followers = lmbDBAL::selectQuery('user_following')
      ->addField('user_id')
      ->addField('follower_user_id')
      ->addCriteria(
          lmbSQLCriteria::equal('user_id', $user->id)
            ->addOr(lmbSQLCriteria::equal('follower_user_id', $user->id))
      )
      ->fetch()->toFlatArray();

    $exported->followers_count = 0;
    $exported->following_count = 0;
    $exported->following = false;

    $is_owner = $this->current_user && $this->current_user->id == $user->id;

    foreach($following_and_followers as $ff)
    {
      if($user->id == $ff['user_id'])
        $exported->followers_count++;

      if($user->id == $ff['follower_user_id'])
        $exported->following_count++;

      if($this->current_user && !$is_owner && !$exported->following)
        if($user->id == $ff['user_id'] && $this->current_user->id == $ff['follower_user_id'])
          $exported->following = true;
    }

    if($is_owner)
    {
      $exported->email = $user->email;
	    $exported->instagram_connected = (bool) $user->instagram_uid;
	    $exported->flickr_connected = (bool) $user->flickr_uid;
    }

    return $exported;
  }

  function exportUserItem(User $user)
  {
    $exported = $this->exportUserSubentity($user);

    if($this->current_user && $this->current_user->id != $user->id)
    {
      $exported->following = (bool) UserFollowing::isUserFollowUser($user, $this->current_user);
    }

    return $exported;
  }

  function exportUserSubentity(User $user)
  {
    $exported = $user->exportForApi();

    unset($exported->birthday);

    return $exported;
  }

  function exportUserItems($users)
  {
    $following = [];
    if($this->current_user)
      $following = UserFollowing::isUserFollowUsers($this->current_user, $users);

    $exported = [];
    foreach($users as $followed)
    {
      $export = $this->exportUserItem($followed);

      if(count($following))
        $export->following = (bool) $following[$followed->id];

      $exported[] = $export;
    }

    return $exported;
  }

  function attachUserSubentityToExport(User $user, stdClass $exported)
  {
    $exported->user = $this->exportUserItems([$user])[0];
    unset($exported->user_id);
  }

  function exportFacebookUserItems(array $facebook_users)
  {
    $exported_list = [];
    $users = User::findByFacebookUid(lmbArrayHelper::getColumnValues('facebook_uid', $facebook_users));
    $users = lmbArrayHelper::makeKeysFromColumnValues('facebook_uid', $users);

    foreach($facebook_users as $facebook_user)
    {
      $exported            = new stdClass;
      $exported->uid       = $facebook_user['facebook_uid'];
      $exported->name      = $facebook_user['name'];
      $exported->image_150 = $facebook_user['pic_big'];
	    $exported->image_50 = $facebook_user['pic_square'];

      if(isset($users[$exported->uid]))
      {
        $user = $users[$exported->uid];
        $exported->user = $user->exportForApi();
        if($this->current_user)
          $exported->user->following = UserFollowing::isUserFollowUser($this->current_user, $user);
      }
      else
        $exported->user = null;

      $exported_list[] = $exported;
    }
    return $exported_list;
  }

  ############### Moment ###############
  function exportMoment(Moment $moment)
  {
    return $this->exportMomentSubentity($moment);
  }

  function exportMomentItem(Moment $moment)
  {
    return $this->exportMomentSubentity($moment);
  }

  function exportMomentSubentity(Moment $moment)
  {
    $exported = $moment->exportForApi();

    unset($exported->day_id);

    $exported->likes_count    = (int) MomentLike::find(lmbSQLCriteria::equal('moment_id', $moment->id))->count();
    $exported->comments_count = (int) MomentComment::find(lmbSQLCriteria::equal('moment_id', $moment->id))->count();

    return $exported;
  }

  function exportMomentItems($moments)
  {
    if(!count($moments))
      return [];

    $moments_ids = lmbArrayHelper::getColumnValues('id', $moments);

    $likes = lmbDBAL::selectQuery('moment_like')
      ->addField('moment_id')
      ->addField('user_id')
      ->addCriteria(lmbSQLCriteria::in('moment_id', $moments_ids))
      ->fetch()->toFlatArray();

    $comments_count = lmbDBAL::selectQuery('moment_comment')
      ->addField('moment_id')
      ->addRawField('COUNT(id)', 'count')
      ->addGroupBy('moment_id')
      ->addCriteria(lmbSQLCriteria::in('moment_id', $moments_ids))
      ->fetch()->toFlatArray();
    $comments_count = lmbArrayHelper::makeKeysFromColumnValues('moment_id', $comments_count);

    $result = [];
    foreach($moments as $moment)
    {
      $exported_moment = $moment->exportForApi();
      unset($exported_moment->day_id);
      $exported_moment->likes_count = 0;
      $exported_moment->is_liked = false;
	    if($moment->is_hidden)
		    $exported_moment->is_hidden = true;
      foreach($likes as $like)
      {
        if($like['moment_id'] != $moment->id)
          continue;
        $exported_moment->likes_count++;
        if($this->current_user && $like['user_id'] == $this->current_user->id)
          $exported_moment->is_liked = true;
      }
      $exported_moment->comments_count = isset($comments_count[$moment->id]) ? $comments_count[$moment->id]['count'] : 0;
	    $order_key = str_pad($moment->time.'', 10, '0', STR_PAD_LEFT).str_pad($moment->id, 8, '0', STR_PAD_LEFT);
      $result[$order_key] = $exported_moment;
    }
	  ksort($result);
    return array_values($result);
  }

  ############### Comments ###############
  protected function exportComment($comment)
  {
    $exported = $comment->exportForApi();

    $this->attachUserSubentityToExport($comment->getUser(), $exported);

    return $exported;
  }

  ################ > DayComments ###############
  function exportDayComment(DayComment $comment)
  {
    return $this->exportDayCommentItem($comment);
  }

  function exportDayCommentItem(DayComment $comment)
  {
    return $this->exportDayCommentSubentity($comment);
  }

  function exportDayCommentSubentity(DayComment $comment)
  {
    $exported = $this->exportComment($comment);

    unset($exported->day_id);

    return $exported;
  }

  function exportDayCommentItems($comments)
  {
    if(!count($comments))
      return [];

    $exported = [];

    $comment_users_ids = lmbArrayHelper::getColumnValues('user_id', $comments);
    $comment_users     = User::findByIds($comment_users_ids);
    $comment_users     = lmbArrayHelper::makeKeysFromColumnValues('id', $comment_users);

    foreach ($comments as $comment) {
      $exported_comment = $comment->exportForApi();
      $exported_comment->user = $this->exportUserSubentity($comment_users[$exported_comment->user_id]);
      unset($exported_comment->user_id);
      $exported[] = $exported_comment;
    }
    return $exported;
  }

  ################ > Likes ###############
  function exportDayLikeItems($likes)
  {
    if(!count($likes))
      return [];

    $exported = [];

    $like_users_ids = lmbArrayHelper::getColumnValues('user_id', $likes);
    $like_users     = User::findByIds($like_users_ids);
    $like_users     = lmbArrayHelper::makeKeysFromColumnValues('id', $like_users);

    foreach ($likes as $like) {
      $exported_like = $like->exportForApi();
      $exported_like->user = $this->exportUserSubentity($like_users[$exported_like->user_id]);
      unset($exported_like->user_id);
      unset($exported_like->day_id);
      $exported[] = $exported_like;
    }
    return $exported;
  }

  ################ > MomentComments ###############
  function exportMomentComment(MomentComment $comment)
  {
    return $this->exportMomentCommentItem($comment);
  }

  function exportMomentCommentItem(MomentComment $comment)
  {
    return $this->exportMomentCommentSubentity($comment);
  }

  function exportMomentCommentSubentity(MomentComment $comment)
  {
    $exported = $this->exportComment($comment);

    unset($exported->moment_id);

    return $exported;
  }

  function exportMomentCommentItems($comments)
  {
    if(!count($comments))
      return [];

    $exported = [];

    $comment_users_ids = lmbArrayHelper::getColumnValues('user_id', $comments);
    $comment_users     = User::findByIds($comment_users_ids);
    $comment_users     = lmbArrayHelper::makeKeysFromColumnValues('id', $comment_users);

    foreach ($comments as $comment) {
      $exported_comment = $comment->exportForApi();
      $exported_comment->user = $this->exportUserSubentity($comment_users[$exported_comment->user_id]);
      unset($exported_comment->user_id);
      $exported[] = $exported_comment;
    }

    return $exported;
  }

  ############### News ###############
  ################ > News ###############
  function exportNewsListItem(News $news, $with_site_urls = false)
  {
    $exported = $news->exportForApi();

    if($news->sender_id)
      $exported->sender = $this->exportUserItem(User::findById($news->sender_id));

	  if($with_site_urls)
		  $exported->text = $news->getMessageWithSiteUrls();

    return $exported;
  }

  function exportNewsItems($news, $with_site_urls = false)
  {
    if(!count($news))
      return [];

    $exported = [];

    $senders_ids = lmbArrayHelper::getColumnValues('sender_id', $news);
    $sender_users     = User::findByIds($senders_ids);
    $sender_users     = lmbArrayHelper::makeKeysFromColumnValues('id', $sender_users);

	  $days_ids = lmbArrayHelper::getColumnValues('day_id', $news);
	  $days     = Day::findByIds($days_ids);
	  $days     = lmbArrayHelper::makeKeysFromColumnValues('id', $days);

	  $days_comments_ids = lmbArrayHelper::getColumnValues('day_comment_id', $news);
	  $days_comments     = DayComment::findByIds($days_comments_ids);
	  $days_comments     = lmbArrayHelper::makeKeysFromColumnValues('id', $days_comments);

	  $moments_ids = lmbArrayHelper::getColumnValues('moment_id', $news);
	  $moments     = Moment::findByIds($moments_ids);
	  $moments     = lmbArrayHelper::makeKeysFromColumnValues('id', $moments);

	  $moment_comments_ids = lmbArrayHelper::getColumnValues('moment_comment_id', $news);
	  $moment_comments     = MomentComment::findByIds($moment_comments_ids);
	  $moment_comments     = lmbArrayHelper::makeKeysFromColumnValues('id', $moment_comments);

    foreach ($news as $news_item)
    {
      $news_item_exported =  $news_item->exportForApi();
	    if($with_site_urls)
		    $news_item_exported->text = $news_item->getMessageWithSiteUrls();
	    $news_item_exported->sender = $this->exportUserSubentity($sender_users[$news_item->sender_id]);
	    if($news_item->day_id)
		    $news_item_exported->day = $this->exportDaySubentity($days[$news_item->day_id]);
	    if($news_item->day_comment_id)
		    $news_item_exported->day_comment = $this->exportDayCommentSubentity($days_comments[$news_item->day_comment_id]);
	    if($news_item->moment_id)
		    $news_item_exported->moment = $this->exportMomentSubentity($moments[$news_item->moment_id]);
	    if($news_item->moment_comment_id)
		    $news_item_exported->moment_comment = $this->exportMomentSubentity($moment_comments[$news_item->moment_comment_id]);
      $exported[] = $news_item_exported;
    }
    return $exported;
  }

  ################ > Activity ###############
  function exportActivityListItem(News $activity)
  {
    return $activity->exportForApi();
  }

  function exportActivityItems($activities)
  {
    $exported = [];
    foreach ($activities as $activity) {
      $exported[] = $this->exportActivityListItem($activity);
    }
    return $exported;
  }

  ############### Complain ###############
  function exportComplaint(Complaint $complaint)
  {
    return $this->exportComplaintSubentity($complaint);
  }

  function exportComplaintListItem(Complaint $complaint)
  {
    return $this->exportComplaintSubentity($complaint);
  }

  function exportComplaintSubentity(Complaint $complaint)
  {
    return $complaint->exportForApi();
  }

  function exportComplaintItems($complaints)
  {
    $exported = [];
    foreach ($complaints as $complaint) {
      $exported[] = $this->exportComplaintListItem($complaint);
    }
    return $exported;
  }
}
