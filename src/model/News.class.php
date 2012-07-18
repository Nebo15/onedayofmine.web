<?php

/**
 * @api
 */
class News extends BaseModel
{
  protected function _defineRelations()
  {
    $this->_many_belongs_to = array (
      'recipient'=> array ('field' => 'recipient_id', 'class' => 'User'),
      'user'     => array ('field' => 'user_id',      'class' => 'User'),
      'day'      => array ('field' => 'day_id',       'class' => 'Day',    'can_be_null' => true),
      'moment'   => array ('field' => 'moment_id',    'class' => 'Moment', 'can_be_null' => true),
    );
  }
}
