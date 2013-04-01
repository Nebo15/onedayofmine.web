<?php
lmb_require('src/model/base/BaseModel.class.php');

/**
 * @api
 */
class Complaint extends BaseModel
{
  protected $_db_table_name = 'complaint';
  protected $_default_sort_params = array('id'=>'asc');

  public $text;
  public $day_id;
  public $ctime;
  public $cip;

  function setDay(Day $day)
  {
    $this->day_id = $day->id;
  }

  function exportForApi(array $properties = null)
  {
    return parent::exportForApi(array(
      'id', 'text', 'day_id', 'ctime'
    ));
  }
}
