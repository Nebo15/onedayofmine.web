<?php

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
    return 'http://upload.wikimedia.org/wikipedia/commons/8/84/Example.svg';
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
}
