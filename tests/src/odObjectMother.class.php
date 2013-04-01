<?php

class odObjectMother
{
  protected $generate_random = true;

  /**
   * @return User
   */
  function user($name = null)
  {
    $user = new User();
    $user->facebook_uid = $this->string(5);
    $user->facebook_access_token = $this->string(50);
    $user->email = $this->email();
    $user->facebook_profile_utime = $this->integer(11);
    $user->name = $name ?: $this->string(100);
    $user->timezone = $this->integer(1);
    $user->sex = 'female';
    $user->occupation = 'occupation_'.$this->string(50);
	  $user->location = 'location_'.$this->string(50);
    $user->birthday = $this->date_sql();
    $user->save();
    return $user;
  }

  function follow(User $user, User $follower)
  {
    $link = new UserFollowing();
    $link->setUser($user);
    $link->setFollowerUser($follower);
    return $link->save();
  }

  /**
   * @param null|User $user
   * @return Day
   */
  function day(User $user = null, $title = null)
  {
    $day = new Day();

    $day->title = $title ?: $this->string(25);
    $day->setUser($user ?: $this->user());

    $types = Day::getTypes();
    if(!$this->generate_random)
      $day->type = $types[0];
    else
      $day->type = $types[array_rand($types)];

    $day->views_count = rand(0, 100);

    $day->save();

    return $day;
  }

  function dayWithMoments(User $user = null, $title = null, Day $day = null)
  {
    $day = $day ?: $this->day($user, $title);
    $this->moment($day);
    $day->attachImage($this->image());
    $day->save();

    return $day;
  }

  function dayWithComments(User $user = null, $title = null, Day $day = null)
  {
    $day = $day ?: $this->day($user, $title);

    for($i = 0; $i < lmbToolkit::instance()->getConf('common')->default_comments_count + 1; $i++)
      $this->dayComment($day, User::findById($day->user_id));

    $day->save();

    return $day;
  }

  function dayWithLikes(User $user, $count)
  {
    $day = $this->day($user);
    $this->dayLikes($day, $count);
    return $day;
  }

  function dayWithMomentsAndComments(User $user = null, $title = null, Day $day = null)
  {
    $day = $day ?: $this->day($user, $title);

    $day = $this->dayWithMoments($user, null, $day);
    $day = $this->dayWithComments($user, null, $day);

    $day->save();

    return $day;
  }

  function favorite(Day $day, User $user)
  {
    $link = new DayFavorite();
    $link->setDay($day);
    $link->setUser($user);
    return $link->save();
  }

  /**
   * @param Day|null $day
   * @param null|User $user
   * @return DayComment
   */
  function dayComment(Day $day = null, User $user = null)
  {
    $comment = new DayComment();
    $comment->setDay($day ?: $this->day()->save());
    $comment->setUser($user ?: $this->user()->save());
    $comment->text = $this->string(255);
    $comment->save();
    return $comment;
  }

  /**
   * @param Day $day
   * @param null|User $user
   * @return DayLike
   */
  function dayLike(Day $day, User $user = null)
  {
    $like = new DayLike();
    $like->setDay($day);
    $like->setUser($user ?: $this->user());
    return $like->save();
  }

  function dayLikes(Day $day, $likes_count)
  {
    for ($i=1; $i < $likes_count; $i++) {
      $like = $this->dayLike($day);
      $like->save();
    }
  }

  /**
   * @param Day|null $day
   * @return Moment
   */
  function moment(Day $day = null, $with_comments = false)
  {
    $day = $day ? $day : $this->day();
    $moment = new Moment();
    $moment->description = 'description '.$this->string(125);
	  $moment->time = time() - 60 * 60;
	  $moment->timezone = 0;
	  $moment->setDay($day);
    $moment->save();

    if($with_comments)
    {
      for($i = 0; $i < lmbToolkit::instance()->getConf('common')->default_comments_count+1; $i++)
      {
        $this->momentComment($moment, User::findById($day->user_id));
      }
    }
    return $moment;
  }

  function momentWithImage(Day $day = null, $likes_count = 0)
  {
    $moment = $this->moment($day);
    $moment->save();
    $moment->attachImage($this->image());
    $moment->save();

    for($i = 0; $i < $likes_count; $i++)
      $this->momentLike($moment);

    return $moment;
  }

  function momentWithImageAndComments(Day $day = null, Moment $moment = null)
  {
    $moment = $moment ?: $this->moment($day);

    $day = $this->momentWithImage($user, null, $day);
    $day = $this->dayWithComments($user, null, $day);

    return $day;
  }

  /**
   * @param Moment|null $moment
   * @param null|User $user
   * @return MomentComment
   */
  function momentComment(Moment $moment = null, User $user = null)
  {
    $comment = new MomentComment();
    $comment->setMoment($moment ?: $this->moment());
    $comment->text = $this->string(255);
    $comment->setUser($user ?: $this->user());
    $comment->save();
    return $comment;
  }

  /**
   * @param Moment $moment
   * @param null|User $user
   * @return MomentLike
   */
  function momentLike(Moment $moment, User $user = null)
  {
    $like = new MomentLike();
    $like->setMoment($moment);
    $like->setUser($user ?: $this->user());
    $like->save();
    return $like;
  }

  function complaint($day = null)
  {
    $complaint = new Complaint();
    $complaint->setDay($day ?: $this->day());
    $complaint->text = $this->string(522);
    return $complaint;
  }

  function news(User $creator = null, User $recipient = null) {
    $creator   = $creator   ?: $this->user();
    $recipient = $recipient ?: $this->user();

    $news = new News();
    $news->setSender($creator);
    $news->text = $creator->name . ' likes ' . $recipient->name;
    $news->link = $this->string();
    $news->save();

    $reception = new NewsRecipient();
    $reception->setNews($news);
    $reception->setUser($recipient);
    $reception->save();

    return $news;
  }

  function deviceToken(User $user = null)
  {
    $device_token = new DeviceToken();
    $device_token->token = $this->string(64);
    $device_token->setUser($user ?: $this->user());
    return $device_token->save();
  }

  function deviceNotification(DeviceToken $token = null)
  {
    $notification = new DeviceNotification();
    $notification->setDeviceToken($token ?: $this->deviceToken());
    $notification->text = $this->string(32);
    $notification->icon = $this->integer(1);
    $notification->sound = $this->string();
    $notification->is_sended = 0;
    return $notification->save();
  }

  function string($length = 6)
  {
    $conso = array("b", "c", "d", "f", "g", "h", "j", "k", "l", "m", "n", "p", "r", "s", "t", "v", "w", "x", "y", "z");
    $vocal = array("a", "e", "i", "o", "u");
    $password = "";
    srand((double) microtime() * 1000000);
    $max = $length / 2;
    for ($i = 1; $i <= $max; $i++) {
      $password .= $conso[rand(0, 19)];
      $password .= $vocal[rand(0, 4)];
    }
    return $password;
  }

  function integer($length = 4)
  {
    if(!$this->generate_random)
      return (int) substr(str_repeat("1337", ceil($length/4)+1), 0, $length);

    return rand(1, 10^($length+1) - 1);
  }

  function image()
  {
    static $contents;
    if(!$contents)
      $contents = file_get_contents(__DIR__.'/../init/image_128x128.jpg');
    return $contents;
  }

  function image_name()
  {
    return $this->string().'.jpg';
  }

  function email() {
    return $this->string(20).'@odm.com';
  }

  function date_sql()
  {
    if(!$this->generate_random)
      return sprintf("%1d-%2$02d-%3$02d", 1990, 1, 2);

    return sprintf("%1d-%2$02d-%3$02d", rand(1900, 1990), rand(0, 1), rand(1, 29));
  }

  function twitter_credentials()
  {
    return array(
      array(
        'uid'                 => '637083468',
        'access_token'        => '637083468-nBzWGwpdfgTqrg2H3DZwnSgBWwMkbNmxVrwCVepx',
        'access_token_secret' => '4jWX2ozuXHcY4yRwqjFBUfV08t7kFjfxBR1OCV7Y0'
      ),
      array(
        'uid'                 => '718050210',
        'access_token'        => '718050210-SVERCoH3Zrxiw1KiBqjN3khC6tb6Rfwzkpx4D2kt',
        'access_token_secret' => 'KoZL6VY45Wfp0laFXhETkEdSKFdIY92YpRfCkzZu4'
      )
    );
  }

  function facebookInfo($uid = null)
  {
    return array(
      'facebook_uid'      => $uid ?: $this->integer(20),
      'email'            => $this->email(),
      'name'             => $this->userName(),
      'sex'              => User::SEX_MALE,
      'timezone'         => $this->integer(1),
      'facebook_profile_utime' => $this->integer(11),
      'pic'              => 'http://fbcdn.com/'.$this->image_name(),
      'pic_big'          => 'http://fbcdn.com/'.$this->image_name(),
	    'pic_square'       => 'http://fbcdn.com/'.$this->image_name(),
      'occupation'       => $this->string(),
      'current_location' => $this->string(),
      'birthday'         => $this->date_sql()
    );
  }

  function userName()
  {
    $names = [
      'Matt', 'Stew', 'Andrew', 'Mike', 'Josh', 'Joe', 'Drew'
    ];
    $surnames = [
      'Romanova', 'Steinheart', 'Johnson', 'Williams', 'Smith', 'Brown', 'Davis', 'Moore'
    ];

    if($this->generate_random)
      return $names[array_rand($names)] . ' ' . $surnames[array_rand($surnames)];
    else
      return $names[0] . ' ' . $surnames[0];
  }
}
