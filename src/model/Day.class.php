<?php
lmb_require('src/model/BaseModel.class.php');

/**
 * @api field int id User ID
 * @static Day findById()
 */
class Day extends BaseModel
{
  const IMAGE_ORIG = 'orig';
  const IMAGE_SMALL = '266x200';
  const IMAGE_BIG = '532x400';

  protected function _defineRelations()
  {
    $this->_many_belongs_to = array(
      'user' => array( 'field' => 'user_id', 'class' => 'User'),
    );

    $this->_has_many = array(
      'moments' => array( 'field' => 'day_id', 'class' => 'Moment'),
      'comments' => array( 'field' => 'day_id', 'class' => 'DayComment'),
    );
  }

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('user');
    $validator->addRequiredObjectRule('user', 'User');
    $validator->addRequiredRule('title');
    $validator->addRequiredRule('occupation');
    $validator->addRequiredRule('timezone');
    // $validator->addRequiredRule('location');
    $validator->addRequiredRule('type');
    return $validator;
  }

  function exportForApi()
  {
    $export = new stdClass();
    $export->id = $this->getId();
    $export->user_id = $this->getUser()->getId();
    $export->fb_uid = $this->getUser()->fb_uid;
    $export->cover_image_266 = lmbToolkit::instance()->getStaticUrl($this->getImageSmall());
    $export->cover_image_532 = lmbToolkit::instance()->getStaticUrl($this->getImageBig());
    $export->title = $this->getTitle();
    $export->occupation = $this->getOccupation();
    $export->timezone = $this->getTimezone();
    $export->location = $this->getLocation();
    $export->type = $this->getType();
    $export->likes_count = $this->getLikesCount() ?: 0;
    $export->ctime = $this->getCreateTime();
    $export->utime = $this->getUpdateTime();
    $export->is_ended = $this->getIsEnded() ?: 0;

    if($this->getIsDeleted())
      $export->is_deleted = true;

    return $export;
  }

  function attachImage($filename_or_url, $content)
  {
    $extension = strtolower(substr($filename_or_url, strrpos($filename_or_url, '.')+1));
    $this->setImageExt($extension);

    $orig_file = lmbToolkit::instance()->getAbsolutePath($this->getImageOrig());
    lmbFs::safeWrite($orig_file, $content);

    $small_file = lmbToolkit::instance()->getAbsolutePath($this->getImageSmall());
    $helper = new lmbConvertImageHelper($orig_file);
    $helper->resizeAndCropFrame(array('width' => 266, 'height' => 200));
    $helper->save($small_file);

    $small_file = lmbToolkit::instance()->getAbsolutePath($this->getImageBig());
    $helper = new lmbConvertImageHelper($orig_file);
    $helper->resizeAndCropFrame(array('width' => 532, 'height' => 400));
    $helper->save($small_file);
  }

  function getImageOrig()
  {
    return $this->getImagePath(self::IMAGE_ORIG);
  }

  function getImageSmall()
  {
    return $this->getImagePath(self::IMAGE_SMALL);
  }

  function getImageBig()
  {
    return $this->getImagePath(self::IMAGE_BIG);
  }

  function getImagePath($size_variation)
  {
    if(!$this->getImageExt())
      return null;
    if(!$this->getId())
      return null;
    if(!$this->getUser() || !$this->getUser()->getId())
      return null;
    $user_id = $this->getUser()->getId();
    $hash = sha1('s0l7&p3pp$r'.$user_id.$this->getId());
    $ext = $this->getImageExt();
    return "users/$user_id/days/{$hash}_$size_variation.$ext";
  }

  static function getTypes()
  {
    $sql = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'day' AND COLUMN_NAME = 'type'";
    $stmt = (new Day())->getDefaultConnection()->newStatement($sql); // connection recieving is ugly
    $stmt->execute(); // выполнит запрос.
    if(preg_match('/^enum\((.*)\)$/', $stmt->getOneRecord()->get('COLUMN_TYPE'), $matches) === 1) {
      return str_getcsv($matches[1], ',', "'");
    } else {
      throw new lmbException("Can't allocate day types.", array('query_result' => $stmt->getOneRecord()->get('COLUMN_TYPE'), 'preg_matches' => $matches));
    }
  }

  /**
   * @return lmbCollectionInterface
   */
  static function findByUsersIds(array $ids, $from_id = null, $to_id = null, $limit = null)
  {
		$criteria = lmbSQLCriteria::in('user_id', $ids);
		$criteria->add('is_deleted = 0');
		if($from_id)
			$criteria->add(lmbSQLCriteria::less('id', $from_id));
		if($to_id)
			$criteria->add(lmbSQLCriteria::greater('id', $to_id));
		return Day::find(array(
      'criteria' => $criteria,
      'limit' => (!$limit || $limit > 100) ? 100 : $limit,
      'sort' => array('id' => 'DESC'),
    ));
  }

  /**
   * @return lmbCollectionInterface
   */
  static function findNew($from_id = null, $to_id = null, $limit = null)
  {
		$criteria = lmbSQLCriteria::equal('is_deleted', 0);
		if($from_id)
			$criteria->add(lmbSQLCriteria::less('id', $from_id));
		if($to_id)
			$criteria->add(lmbSQLCriteria::greater('id', $to_id));
		return Day::find(array(
      'criteria' => $criteria,
      'limit' => (!$limit || $limit > 100) ? 100 : $limit,
      'sort' => array('id' => 'DESC')
    ));
  }

  static function findUnfinished(User $user)
  {
  	$criteria = lmbSQLCriteria::equal('is_deleted', 0);
  	$criteria->add(lmbSQLCriteria::equal('is_ended', 0));
  	$days = $user->getDays()->find(array('criteria' => $criteria));
  	if(count($days) > 1)
  		throw new lmbException("User {$user->getId()} has more than one open day");
  	return $days->at(0);
  }

  static function findByString($query, $from_id = null, $to_id = null, $limit = null)
  {
    $criteria = lmbSQLCriteria::equal('is_deleted', 0);
    if($from_id)
      $criteria->add(lmbSQLCriteria::less('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::greater('id', $to_id));
    $criteria->add(lmbSQLCriteria::like('title', '%'.$query.'%'));

    return Day::find(array(
      'criteria' => $criteria,
      'limit' => (!$limit || $limit > 100) ? 100 : $limit,
      'sort' => array('id' => 'DESC')
    ));
  }
}
