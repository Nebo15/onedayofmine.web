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

  protected $_default_sort_params = array('time' => 'ASC');

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

  function exportForApi(array $properties = null)
  {
    $moment = new stdClass();
    $moment->id = $this->getId();
    $moment->day_id = $this->getDayId();
    $moment->description = $this->getDescription();
    $this->showImages($moment);
    $moment->time = self::stampToIso($this->getTime(), $this->getTimezone());

    if($this->getIsDeleted())
      $moment->is_deleted = true;

    return $moment;
  }

  function getCommentsWithLimitation($from_id = null, $to_id = null, $limit = null)
  {
    $criteria = new lmbSQLCriteria();
    if($from_id)
      $criteria->add(lmbSQLCriteria::greater('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::less('id', $to_id));
    if(!$limit || $limit > 100)
      $limit = 100;
    return $this->getComments()->find(array(
      'criteria' => $criteria,
      'sort' => array('id' => 'ASC')
    ))->paginate(0, $limit);
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
