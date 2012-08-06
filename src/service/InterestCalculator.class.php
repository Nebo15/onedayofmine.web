<?php
lmb_require('limb/core/src/lmbArrayHelper.class.php');
lmb_require('limb/dbal/src/query/lmbSelectQuery.class.php');
lmb_require('limb/dbal/src/query/lmbDeleteQuery.class.php');
lmb_require('limb/dbal/src/query/lmbInsertQuery.class.php');

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
    $current_time = time();

    $query = new lmbSelectQuery('day');
    $query->addField('day.id');
    $query->addRawField("`likes_count`/(($current_time-`ctime`)/86400) as rating");
    $query->addLeftJoin('day_interest', 'day_id', 'day', 'id');
    $query->addCriteria(lmbSQLCriteria::equal('is_deleted', 0));
    $query->addCriteria(lmbSQLCriteria::isNull('day_interest.day_id'));
    $query->addRawOrder("rating DESC");

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

  }

  function unpinDay($day_id)
  {

  }

  function getDays($from_id = null, $to_id = null, $limit = null)
  {
    $query = new lmbSelectQuery('day_interest');
    $query->addField('day_id');
    $query->addRawOrder("rating DESC");

    $ids = lmbArrayHelper::getColumnValues('day_id', $query->fetch());

    if($from_id)
    {
      $founded_pos = array_search((string) $from_id, $ids);
      $from_key =  false !== $founded_pos ? $founded_pos + 1 : 0;
    }
    else
      $from_key = 0;

    if($to_id)
    {
      $founded_pos = array_search((string) $to_id, $ids);
      $to_key =  false !== $founded_pos ? $founded_pos - 1: 0;
    }
    else
      $to_key = count($ids);

    if(!$limit)
      $limit = 100;

    $ids = array_slice($ids, $from_key, $to_key);
    $ids = array_slice($ids, 0, $limit);

    $days = Day::findByIds($ids);
    foreach($days as $position => $day)
    {
      if(1 === $day->getIsDeleted())
        unset($days[$position]);
    }
    return $days;
  }
}