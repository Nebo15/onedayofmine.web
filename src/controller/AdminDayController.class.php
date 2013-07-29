<?php
lmb_require('src/controller/AdminObjectController.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/DayInterestRecord.class.php');
lmb_require('src/service/InterestCalculator.class.php');

class AdminDayController extends AdminObjectController
{
  protected $_object_class_name = 'Day';
	/**
	 * @var InterestCalculator
	 */
	protected $interest_calculator;

  function doInteresting()
  {
	  $this->interest_calculator = new InterestCalculator();
    $this->items = $this->interest_calculator->getDaysRatings();
  }

  function doInterestingAdd()
  {
    $this->useForm($this->_form_name);

    if($this->request->hasPost())
    {
      $item = new DayInterestRecord();
      if(!$day = Day::findById($this->request->getInteger('day_id')))
        $this->error_list->addError('Day not found by id = '.$this->request->get('day_id'));
      $item->import($this->request);
      $item->validate($this->error_list);
      if($this->error_list->isValid())
      {
        $item->saveSkipValidation();
        $this->_endDialog();
      }
    }
  }

  function doInterestingEdit()
  {
	  if(!$id = $this->request->get('id'))
		  return $this->forwardTo404();
	  if(!$this->item = DayInterestRecord::findById($id))
		  return $this->forwardTo404();

	  $this->useForm($this->_form_name);
	  $this->setFormDatasource($this->item);

	  if($this->request->hasPost())
	  {
		  $this->item->rating = $this->request->get('rating');
		  $this->item->is_pinned = $this->request->get('is_pinned');
		  $this->item->validate($this->error_list);
		  if($this->error_list->isValid())
			  $this->item->saveSkipValidation();
		  $this->_endDialog();
	  }
	  else
	  {
		  $this->_initEditForm();
	  }
  }

  function doInterestingPin()
  {
	  $this->interest_calculator->pinDay($this->request->get('id'));
    $this->_endDialog();
  }

  function doInterestingUnpin()
  {
	  $this->interest_calculator->unpinDay($this->request->get('id'));
	  $this->_endDialog();
  }

  function doInterestingDelete()
  {
    $this->_object_class_name = 'DayInterestRecord';
    return parent::doDelete();
  }

  function doInterestingRecalc()
  {
    $calc = new InterestCalculator();
    $calc->deleteUnpinnedDays();
    $calc->fillRating();
    return $this->_endDialog();
  }
}
