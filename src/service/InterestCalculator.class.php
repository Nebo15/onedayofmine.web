<?php
lmb_require('limb/core/src/lmbArrayHelper.class.php');
lmb_require('limb/dbal/src/query/lmbSelectQuery.class.php');
lmb_require('limb/dbal/src/query/lmbDeleteQuery.class.php');
lmb_require('limb/dbal/src/query/lmbInsertQuery.class.php');
lmb_require('src/model/DayInterestRecord.class.php');
lmb_require('src/model/Day.class.php');

class InterestCalculator
{
  function reset()
  {
    $query = new lmbDeleteQuery('day_interest');
    return $query->execute();
  }

  function deleteUnpinnedDays()
  {
    $query = new lmbDeleteQuery('day_interest');
    $query->addCriteria(lmbSQLCriteria::notEqual('is_pinned', 1));
    return $query->execute();
  }

  function fillRating()
  {
	  $current_days_ids = lmbArrayHelper::getColumnValues('day_id', DayInterestRecord::find());
    $current_time = time();

    $query = new lmbSelectQuery('day');
    $query->addField('day.id');
	  $query->addRawField("((SELECT COUNT(*) FROM `day_like` WHERE `day_like`.`day_id` = `day`.`id`)*1000 + day.views_count)/(1+SQRT(FLOOR($current_time-`day`.`ctime`)/86400)) as rating");
    $query->addLeftJoin('day_interest', 'day_id', 'day', 'id');
	  $query->addLeftJoin('user', 'id', 'day', 'user_id');
    $query->addCriteria(
	    lmbSQLCriteria::equal('is_deleted', 0)
			    ->add(lmbSQLCriteria::notIn('day.id', $current_days_ids))
    );
    $query->addRawOrder("rating DESC, day.id DESC");

    $days_rating = lmbArrayHelper::convertToFlatArray($query->fetch()->paginate(0, 100));

    foreach($days_rating as $day_rating)
    {
      $query = new lmbInsertQuery('day_interest');
      $query->addField('day_id', $day_rating['id']);
      $query->addField('rating', $day_rating['rating'] * 1000);
      $query->addField('is_pinned', 0);
      $query->execute();
    }
  }

  function pinDay($day_id)
  {
	  $this->_changePin($day_id, 1);
  }

  function unpinDay($day_id)
  {
	  $this->_changePin($day_id, 0);
  }

	protected function _changePin($day_id, $is_pinned)
	{
		if(!$record = DayInterestRecord::findByDayId($day_id))
		{
			$record = new DayInterestRecord();
			$record->day_id = $day_id;
			$record->rating = 1;
		}
		$record->is_pinned = $is_pinned;
		$record->save();
	}

  function getDaysRatings($from_day_id = null, $to_day_id = null, $limit = null)
  {
    $query = new lmbSelectQuery('day_interest');
    $query->addField('*');
    $query->addRawOrder("rating DESC, day_id DESC");
    $info = $query->fetch();

    $ids = lmbArrayHelper::getColumnValues('day_id', $info);

    if($from_day_id)
    {
      $founded_pos = array_search((string) $from_day_id, $ids);
      $from_key =  false !== $founded_pos ? $founded_pos + 1 : 0;
    }
    else
      $from_key = 0;

    if($to_day_id)
    {
      $founded_pos = array_search((string) $to_day_id, $ids);
	    $to_key =  false !== $founded_pos ? $founded_pos: 0;
    }
    else
      $to_key = count($ids);

    if(!$limit)
      $limit = 100;

    $ids = array_slice($ids, $from_key, $to_key - $from_key);
    $ids = array_slice($ids, 0, $limit);

    if(!count($ids))
      return [];

    $days_with_rating = [];
    foreach(Day::findByIds($ids) as $day)
    {
      if(1 == $day->is_deleted)
        continue;
	    if(!$day->getImage())
		    continue;
      foreach($info as $record)
      {
        if($record['day_id'] != $day->id)
          continue;

        $recordObj = new DayInterestRecord();
        $recordObj->import($record->export());
        $recordObj->setDay($day);
        // $recordObj->setRating(array_search($day->id, $ids)); useless as DayInterestRecord
        $days_with_rating[array_search($day->id, $ids)] = $recordObj;
      }
    }

    ksort($days_with_rating);

    return $days_with_rating;
  }
}
