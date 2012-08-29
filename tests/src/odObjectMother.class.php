<?php

class odObjectMother
{
  protected $generate_random = false;

  public function __construct()
  {
    // TODO when its better to have static values?
    $this->generate_random = (lmb_env_get('LIMB_APP_MODE') != 'devel');
  }

  /**
   * @return User
   */
  function user($name = null)
  {
    $user = new User();
    $user->setFbUid($this->string(5));
    $user->setFbAccessToken($this->string(50));
    $user->setEmail($this->email());
    $user->setFbProfileUtime($this->integer(11));
    $user->setFbPicBig($this->string(50));
    $user->setFbPicSquare($this->string(50));
    $user->setFbPicSmall($this->string(50));
    $user->setName($name ?: $this->string(100));
    $user->setTimezone($this->integer(1));
    $user->setSex('female');
    $user->setOccupation($this->string(50));
    $user->setBirthday($this->date_sql());

    $settings = new UserSettings();
    $settings->setNotificationsNewDays(0);
    $settings->setNotificationsNewComments(0);
    $settings->setNotificationsRelatedActivity(0);
    $settings->setNotificationsShootingPhotos(0);
    $settings->setPhotosSaveOriginal(0);
    $settings->setPhotosSaveFiltered(0);
    $settings->setSocialShareFacebook(0);
    $settings->setSocialShareTwitter(0);
    $user->setSettings($settings);

    return $user;
  }

  /**
   * @param null|User $user
   * @return Day
   */
  function day(User $user = null, $with_comments = false)
  {
    $day = new Day();
    $day->setTitle($this->string(25));
    $day->setOccupation($this->string(255));
    $day->setTimezone(0);
    $day->setLocation($this->string(25));
    $types = Day::getTypes();

    if(!$this->generate_random)
      $day->setType($types[0]);
    else
      $day->setType($types[array_rand($types)]);

    if($with_comments)
    {
      for($i = 0; $i < lmbToolkit::instance()->getConf('common')->default_comments_count+1; $i++)
      {
        $day->addToComments($this->dayComment($day, $day->getUser()));
      }
    }

    $day->setUser($user ?: $this->user());
    return $day;
  }

  /**
   * @param Day|null $day
   * @param null|User $user
   * @return DayComment
   */
  function dayComment(Day $day = null, User $user = null)
  {
    $comment = new DayComment();
    $comment->setDay($day ?: $this->day());
    $comment->setUser($user ?: $this->user());
    $comment->setText($this->string(255));
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
    return $like;
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
    $moment = new Moment();
    $moment->setDescription('description '.$this->string(125));
    $moment->setDay($day ?: $this->day());

    if($with_comments)
    {
      for($i = 0; $i < lmbToolkit::instance()->getConf('common')->default_comments_count+1; $i++)
      {
        $moment->addToComments($this->momentComment($moment, $moment->getDay()->getUser()));
      }
    }

    return $moment;
  }

  function momentSavedWithImage(Day $day = null)
  {
    $moment = $this->moment($day);
    $moment->save();
    $moment->attachImage('foo.gif', file_get_contents('http://placehold.it/300x300'));
    $moment->save();
    return $moment;
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
    $comment->setText($this->string(255));
    $comment->setUser($user ?: $this->user());
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
    return $like;
  }

  function complaint($day = null)
  {
    $complaint = new Complaint();
    $complaint->setDay($day ?: $this->day());
    $complaint->setText($this->string(522));
    return $complaint;
  }

  function news(User $creator = null, User $recipient = null) {
    $creator   = $creator   ?: $this->user();
    $recipient = $recipient ?: $this->user();

    $news = new News();
    $news->setRecipient($recipient);
    $news->setUser($creator);
    $news->setText($creator->name . ' likes ' . $recipient->name);
    return $news;
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
    return file_get_contents(__DIR__.'/../init/image_800x800.jpg');
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
     'fb_uid'           => $uid ?: $this->string(5),
      'email'            => $this->email(),
      'name'             => $this->string(10),
      'sex'              => User::SEX_MALE,
      'timezone'         => $this->integer(1),
      'fb_profile_utime' => $this->integer(11),
      'pic'              => $this->string(),
      'occupation'       => $this->string(),
      'current_location' => $this->string(),
      'birthday'         => $this->date_sql()
    );
  }
}
