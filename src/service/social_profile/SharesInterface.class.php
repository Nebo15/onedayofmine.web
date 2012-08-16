<?php
interface SharesInterface
{
  function shareDayBegin(Day $day, $day_url);
  function shareDayEnd(Day $day, $day_url);
  function shareDay(Day $day, $day_url);
  function shareDayLike(Day $day, $day_url);
  function shareMomentAdd(Day $day, $day_url, Moment $moment, $moment_url);
  function shareMomentLike(Moment $moment, $moment_url);
}
