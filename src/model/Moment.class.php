<?php
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/traits/Imageable.trait.php');

/**
 * @api
 * @method string getFacebookUid()
 * @method void setFacebookUid(string $facebook_user_id)
 * @method string getFacebookAccessToken()
 * @method string getDay()
 * @method string getDayId()
 * @method string getDescription()
 * @method void setFacebookAccessToken(string $facebook_access_token)
 */
class Moment extends BaseModel
{
  use Imageable;

  protected function _defineRelations()
  {
    $this->_has_many = array (
      'comments' => array ('field' => 'moment_id', 'class' => 'MomentComment'),
      'likes'    => array( 'field' => 'moment_id', 'class' => 'MomentLike'),
    );
    $this->_many_belongs_to = array (
      'day' => array ('field' => 'day_id', 'class' => 'Day')
    );
  }

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredObjectRule('day', 'Day');
    return $validator;
  }

  function exportForApi()
  {
    $moment = new stdClass();
    $moment->id = $this->getId();
    $moment->day_id = $this->getDayId();
    $moment->description = $this->getDescription();
    $this->showImages($moment);
    $moment->time = self::stampToIso($this->getTime(), $this->getTimezone());
    $moment->ctime = $this->getCtime();

    if($this->getIsDeleted())
      $export->is_deleted = true;

    return $moment;
  }

  protected function _getAdditionalPlaceholders(&$placeholders)
  {
    if(!$this->getDay()->getUser() || !$this->getDay()->getUser()->getId())
      throw new Exception("Can't create image path, because entity have no corresponding User.", array('class' => get_called_class()));

    $placeholders[':user_id'] = $this->getDay()->getUser()->getId();
    $placeholders[':day_id']  = $this->getDay()->getId();
    $placeholders[':hash']    = sha1('s0l7&p3pp$r'.$this->getDay()->getUser()->getId().$this->getId().$this->getDay()->getId());
  }
}
