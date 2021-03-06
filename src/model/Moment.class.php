<?php
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/traits/Imageable.class.php');
lmb_require('src/model/MomentComment.class.php');
lmb_require('src/model/MomentLike.class.php');
lmb_require('limb/validation/src/rule/lmbPatternRule.class.php');
lmb_require('limb/validation/src/rule/lmbNumericValueRangeRule.class.php');

/**
 * @api
 * @method string facebook_uid
 * @method void setFacebookUid(string $facebook_user_id)
 * @method string facebook_access_token
 * @method string getDayId()
 * @method string getDescription()
 * @method void setFacebookAccessToken(string $facebook_access_token)
 */
class Moment extends BaseModel
{
  use Imageable;

  public $day_id;
  public $location_latitude, $location_longitude, $description, $time, $position, $timezone, $is_hidden, $is_deleted;
	public $instagram_id, $flickr_id, $facebook_id, $twitter_id;

  protected $_default_sort_params = array('time' => 'ASC');
  protected $_db_table_name = 'moment';

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('day_id');

	  if($this->instagram_id)
		  $validator->addRule(new lmbPatternRule('instagram_id', '/[0-9]_/'));

	  $validator->addRequiredRule('time');
	  $validator->addRequiredRule('position');
	  $validator->addRequiredRule('timezone');
	  if($this->time)
	    $validator->addRule(new lmbNumericValueRangeRule('time', 0, time() + $this->timezone * 60 * 60));

    return $validator;
  }

  function exportForApi(array $properties = null)
  {
    $moment = parent::exportForApi(['id', 'day_id', 'description', 'location_latitude', 'location_longitude']);
	  $moment->position = (int) $this->position;
    $this->showImages($moment);
    $moment->time = BaseModel::stampToIso($this->time, $this->timezone);

    if($this->is_deleted)
      $moment->is_deleted = true;

    return $moment;
  }

  function setDay(Day $day)
  {
    $this->day_id = $day->id;
  }

  /**
   * @return Day
   */
  function getDay()
  {
    return Day::findById($this->day_id);
  }

	function _onBeforeSave()
	{
		foreach($this->getDay()->getMoments() as $pos => $moment)
		{
			if($moment->position == $this->position && $moment->id != $this->id)
			{
				$query = new lmbUpdateQuery($this->_db_table_name);
				$query->addRawField('`position` = `position` + 1');
				$query->addCriteria(
					lmbSQLCriteria::equal('day_id', $this->day_id)->add(
						lmbSQLCriteria::greaterOrEqual('position', $this->position)
					)
				);
				$query->execute();
				return;
			}
		}
	}

	function _onAfterDestroy()
	{
		if(!$day = $this->getDay())
			return;
		foreach($day->getMoments() as $pos => $moment)
		{
			if($moment->position == $this->position && $moment->id != $this->id)
			{
				$query = new lmbUpdateQuery($this->_db_table_name);
				$query->addRawField('`position` = `position` - 1');
				$query->addCriteria(
					lmbSQLCriteria::equal('day_id', $this->day_id)->add(
						lmbSQLCriteria::greaterOrEqual('position', $this->position)
					)
				);
				$query->execute();
				return;
			}
		}
	}

  function getComments()
  {
    return MomentComment::find(lmbSQLCriteria::equal('moment_id', $this->id));
  }

  function getLikes()
  {
    return MomentLike::find(lmbSQLCriteria::equal('moment_id', $this->id));
  }

  function getCommentsWithLimitation($from_id = null, $to_id = null, $limit = null)
  {
    $criteria = lmbSQLCriteria::equal('moment_id', $this->id);
    if($from_id)
      $criteria->add(lmbSQLCriteria::greater('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::less('id', $to_id));
    if(!$limit || $limit > 100)
      $limit = 100;
    return MomentComment::find($criteria, ['id' => 'ASC'])->paginate(0, $limit);
  }

  protected function _getAdditionalPlaceholders(&$placeholders)
  {
    if(!$this->day_id)
      throw new Exception("Can't create image path, because entity have no corresponding User.", array('class' => get_called_class()));

    $placeholders[':day_id']  = $this->day_id;
    $placeholders[':hash']    = sha1('s0l7&p3pp$r'.$this->id.$this->day_id);
  }
}
