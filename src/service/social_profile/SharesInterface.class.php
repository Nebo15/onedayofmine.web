<?php
interface SharesInterface
{
  /**
   * @param  string $social_user_id
   * @return int post_id
   */
  function shareInvitation($social_user_id);
  /**
   * @param Day $day
   * @return int share_id
   */
  function shareDayBegin(Day $day);
  /**
   * @param Day $day
   * @return int share_id
   */
  function shareDay(Day $day);

  /**
   * @param Day $day
   * @return int share_id
   */
  function shareDayEnd(Day $day);

  /**
   * @param  Day $day
   * @return boolean
   */
  function shareDayDelete(Day $day);

  /**
   * @param Day $day
   * @param DayLike $like
   * @return int share_id
   */
  function shareDayLike(Day $day, DayLike $like);

  /**
   * @param Day $day
   * @param DayLike $like
   * @return int share_id
   */
  function shareDayUnlike(Day $day, DayLike $like);

  /**
   * @param Day $day
   * @param Moment $moment
   * @return int share_id
   */
  function shareMomentAdd(Day $day, Moment $moment);

  /**
   * @param Day $day
   * @param Moment $moment
   * @return boolean
   */
  function shareMomentDelete(Day $day, Moment $moment);

  /**
   * @param Moment $moment
   * @param MomentLike $like
   * @return int share_id
   */
  function shareMomentLike(Moment $moment, MomentLike $like);

  /**
   * @param Moment $moment
   * @param MomentLike $like
   * @return int share_id
   */
  function shareMomentUnlike(Moment $moment, MomentLike $like);
}
