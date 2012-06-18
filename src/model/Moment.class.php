<?php

/**
 * @method string getFbUid()
 * @method void setFbUid(string $fb_user_id)
 * @method string getFbAccessToken()
 * @method void setFbAccessToken(string $fb_access_token)
 */
class Moment extends lmbActiveRecord
{
  protected $_db_table_name = 'moment';

  protected $_default_sort_params = array('id'=>'asc');

  protected $_lazy_attributes = array('description');

  protected function _defineRelations()
  {
    $this->_has_many = array (
      'moment_comments' => array ('field' => 'moment_id', 'class' => 'MomentComment'),
    );
    $this->_many_belongs_to = array (
      'day' => array ('field' => 'day_id', 'class' => 'Day')
    );
  }

  function getImageUrl()
  {
    return $this->getImagePath();
  }

  function exportToSimpleObj()
  {
    $moment = new stdClass();
    $moment->id = $this->getId();
    $moment->day_id = $this->getDayId();
    $moment->description = $this->getDescription();
    $moment->img_url = $this->getImageUrl();
    $moment->likes_count = $this->getLikesCount();
    $moment->ctime = $this->getCtime();
    return $moment;
  }

  function attachImage($filename, $content)
  {
    $filename = strtolower($filename);
    $extension = substr($filename, strrpos($filename, '.')+1);
    $this->setImageExt($extension);
    $path = $this->getImagePath();
    lmbFs::safeWrite(lmb_env_get('APP_DIR')."/www/".$path, $content);
  }

  function getImagePath()
  {
    if(!$this->getId())
      throw new lmbException("Can't create image path, because moment have no id");
    if(!$this->getDayId())
      throw new lmbException("Can't create image path, because moment have no DAY id");
    if(!$this->getDay()->getUser() || !$this->getDay()->getUser()->getId())
      throw new lmbException("Can't create image path, because moment have no user");
    $user_id = $this->getDay()->getUser()->getId();
    $day_id = $this->getDayId();
    $filename = sha1('s0l7&p3pp$r'.$user_id.$day_id.$this->getId()).'.'.$this->getImageExt();
    return "/media/$user_id/day/$day_id/$filename";
  }
}
