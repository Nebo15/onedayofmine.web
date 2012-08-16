<?php
interface SharesInterface
{
  /**
   * @param Day $day
   * @return int share_id
   */
  function shareDayBegin(Day $day);

  /**
   * @param Day $day
   * @return int share_id
   */
  function shareDayEnd(Day $day);

  /**
   * @param Day $day
   * @return int share_id
   */
  function shareDay(Day $day);

  /**
   * @param Day $day
   * @return int share_id
   */
  function shareDayLike(Day $day);

  /**
   * @param Day $day
   * @param Moment $moment
   * @return int share_id
   */
  function shareMomentAdd(Day $day, Moment $moment);

  /**
   * @param Moment $moment
   * @return int share_id
   */
  function shareMomentLike(Moment $moment);
}
