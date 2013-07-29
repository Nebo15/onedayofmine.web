<?php
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/traits/Imageable.class.php');
lmb_require('src/model/Moment.class.php');
lmb_require('src/model/DayComment.class.php');
lmb_require('src/model/MomentComment.class.php');
lmb_require('src/model/DayLike.class.php');

/**
 * @api field int id User ID
 */
class Day extends BaseModel
{
  use Imageable {
    Imageable::getImage as getImageBase;
  }

  protected $_db_table_name = 'day';
  protected $_default_sort_params = array('id'=>'desc');

	const TYPE_WORKING = 'Working day';
	const TYPE_DAYOFF  = 'Day off';
	const TYPE_HOLIDAY = 'Holiday';
	const TYPE_TRIP    = 'Trip';
	const TYPE_EVENT   = 'Special Event';

  public $user_id;
  public $type;
  public $title;
  public $final_description;
  public $views_count;
	public $location_str;
	public $location_lat;
	public $location_long;
	public $is_gathering_enabled;
  public $is_deleted;
  public $facebook_share_id;
  public $twitter_share_id;
  public $date;
  public $ctime;
  public $utime;
	public $cip;

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('user_id');
    $validator->addRequiredRule('title');
    $validator->addRequiredRule('date');
    $validator->addRequiredRule('type');
    $validator->addRule(new lmbValidValueRule('type', self::getTypes()));
    return $validator;
  }

  function exportForApi(array $properties = null)
  {
    $export = new stdClass();
    $export->id = $this->id;
    $export->user_id = $this->user_id;
    $export->type = $this->type;
    $export->title = $this->title;
	  $this->showImages($export);
    $export->final_description = $this->final_description;
    $export->views_count = $this->views_count ?: 0;
    $export->date = $this->date;
	  $export->ctime = (int) $this->ctime;
	  $export->utime = (int) $this->utime;
	  $export->location_str = $this->location_str;
	  $export->location_lat = (float) $this->location_lat;
	  $export->location_long = (float) $this->location_long;

    return $export;
  }

	function getImage(array $size = null)
	{
		$moments = $this->getMoments();
		if(!$this->image_ext && count($moments))
			return $moments[0]->getImage($size);
		else
			return $this->getImageBase($size);
	}

  function setUser(User $user)
  {
    $this->user_id = $user->id;
  }

  function getMoments()
  {
    $criteria = lmbSQLCriteria::equal('day_id', $this->id)
      ->add(lmbSQLCriteria::equal('is_deleted', 0))
		  ->add(lmbSQLCriteria::equal('is_hidden', 0));

    return Moment::find($criteria, ['position' => 'ASC']);
  }

	function getAllMoments()
	{
		$criteria = lmbSQLCriteria::equal('day_id', $this->id)
				->add(lmbSQLCriteria::equal('is_deleted', 0));

		return Moment::find($criteria, ['position' => 'ASC']);
	}

  function getComments()
  {
    return DayComment::find(lmbSQLCriteria::equal('day_id', $this->id));
  }

  function getLikes()
  {
    return DayLike::find(lmbSQLCriteria::equal('day_id', $this->id));
  }

  protected function _getAdditionalPlaceholders(&$placeholders)
  {
    $placeholders[':hash'] = sha1('s0l7&p3pp$r'.$this->id);
  }

  function getCommentsWithLimitation($from_id = null, $to_id = null, $limit = null)
  {
    $criteria = lmbSQLCriteria::equal('day_id', $this->id);
    if($from_id)
      $criteria->add(lmbSQLCriteria::greater('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::less('id', $to_id));
    if(!$limit || $limit > 100)
      $limit = 100;
    return DayComment::find($criteria, ['id' => 'ASC'])->paginate(0, $limit);
  }

  function getUser()
  {
    return User::findById($this->user_id);
  }

  static function getTypes()
  {
    return ['Working day', 'Day off', 'Holiday', 'Trip'];
  }

  /**
   * @return lmbCollectionInterface
   */
  static function findByUsersIds(array $ids, $from_id = null, $to_id = null, $limit = null)
  {
	  $query = new lmbSelectQuery('day');
	  $query->addField('day.*');
	  $criteria = lmbSQLCriteria::equal('day.is_deleted', 0);
	  $criteria->add(lmbSQLCriteria::isNotNull('moment.id'));
	  $criteria->add(lmbSQLCriteria::in('user_id', $ids));
	  if($from_id)
		  $criteria->add(lmbSQLCriteria::less('day.id', $from_id));
	  if($to_id)
		  $criteria->add(lmbSQLCriteria::greater('day.id', $to_id));
	  $query->addCriteria($criteria);
	  $query->addLeftJoin('moment', 'day_id', 'day', 'id');
	  $query->addGroupBy('day.id');
	  $query->addOrder('day.id', 'DESC');

	  return Day::findByQuery($query)
			  ->paginate(0, (!$limit || $limit > 100) ? 100 : $limit);
  }

  /**
   * @return lmbCollectionInterface
   */
  static function findNew($from_id = null, $to_id = null, $limit = null)
  {
	  $query = new lmbSelectQuery('day');
	  $query->addField('day.*');
	  $criteria = lmbSQLCriteria::equal('day.is_deleted', 0);
	  $criteria->add(lmbSQLCriteria::isNotNull('moment.id'));
	  if($from_id)
		  $criteria->add(lmbSQLCriteria::less('day.id', $from_id));
	  if($to_id)
		  $criteria->add(lmbSQLCriteria::greater('day.id', $to_id));
	  $query->addCriteria($criteria);
	  $query->addLeftJoin('moment', 'day_id', 'day', 'id');
	  $query->addGroupBy('day.id');
	  $query->addOrder('day.id', 'DESC');

    return Day::findByQuery($query)
      ->paginate(0, (!$limit || $limit > 100) ? 100 : $limit);
  }

  static function findByString($query, $from_id = null, $to_id = null, $limit = null)
  {
    $ids  = lmbToolkit::instance()->getSearchService('Day')->find($query, $from_id, $to_id, $limit);
    if(!$ids)
      return [];
    $days = self::findByIds($ids);
    $days = self::sortByIds($days, $ids);
    return $days;
  }

	static function findOldDeletedDays()
	{
		$criteria = lmbSQLCriteria::equal('is_deleted', 1)
				->add(lmbSQLCriteria::less('utime', time() - 30 * 24 * 60 * 60));
		return Day::find($criteria);
	}

	static function findTwoSimilar(Day $day)
	{
		$count = 2;
		if($journal_day_record = DayJournalRecord::findByDayId($day->id))
		{
			$bottom_id_limit = ($journal_day_record->id > $count * 2) ? $journal_day_record->id - $count * 2 : 1;
			$top_id_limit = $journal_day_record->id + $count * 2;
			$similar_days_records = DayJournalRecord::findByIds(range($bottom_id_limit, $top_id_limit), ['id' => 'asc']);
			foreach($similar_days_records as $i => $similar_days_record)
			{
				if($journal_day_record->id == $similar_days_record->id)
				{
					$result = [];
					if($i > 1 && isset($similar_days_records[$i - 2]))
						$result[] = Day::findById($similar_days_records[$i - 2]->day_id);
					if(isset($similar_days_records[$i]))
						$result[] = Day::findById($similar_days_records[$i]->day_id);
					return array_reverse($result);
				}
			}
			return [];
		}
		else
		{
			$bottom_id_limit = ($day->id > $count * 2) ? $day->id - $count * 2 : 1;
			$top_id_limit = $day->id + $count * 2;
			$similar_days = Day::findByIds(range($bottom_id_limit, $top_id_limit), ['id' => 'asc']);
			foreach($similar_days as $i => $one_similar_day)
			{
				if($day->id == $one_similar_day->id)
				{
					$result = [];
					if($i > 1 && isset($similar_days[$i - 2]))
						$result[] = $similar_days[$i - 2];
					if(isset($similar_days[$i]))
						$result[] = $similar_days[$i];
					return array_reverse($result);
				}
			}
			return [];
		}
	}
}
