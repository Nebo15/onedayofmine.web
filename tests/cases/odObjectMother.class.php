<?php

class odObjectMother
{
  /**
   * @return User
   */
  function user()
  {
    $user = new User();
    return $user;
  }

  /**
   * @param null|User $user
   * @return Day
   */
  function day(User $user = null)
  {
    $day = new Day();
    $day->setTitle($this->string(25));
    $day->setDescription($this->string(255));
    $day->setTimeOffset(0);
    $day->setOccupation($this->string(25));
    $day->setAge($this->integer(2));
    $day->setType($this->integer(1));
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
   * @param Day|null $day
   * @return Moment
   */
  function moment(Day $day = null)
  {
    $moment = new Moment();
    $moment->setDay($day ?: $this->day());
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

  function complaint($day = null)
  {
    $complaint = new Complaint();
    $complaint->setDay($day ?: $this->day());
    $complaint->setText($this->string(522));
    return $complaint;
  }

  function string($length = 6)
  {
    $conso = array("b", "c", "d", "f", "g", "h", "j", "k", "l", "m", "n", "p", "r", "s", "t", "v", "w", "x", "y", "z");
    $vocal = array("a", "e", "i", "o", "u");
    $password = "";
    srand((double)microtime() * 1000000);
    $max = $length / 2;
    for ($i = 1; $i <= $max; $i++) {
      $password .= $conso[rand(0, 19)];
      $password .= $vocal[rand(0, 4)];
    }
    return $password;
  }

  function integer($length = 4)
  {
    return rand(1, 10^($length+1) - 1);
  }
}
