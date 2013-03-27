<?php
lmb_require('limb/cms/src/controller/lmbAdminObjectController.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/service/InterestCalculator.class.php');

class AdminDayController extends lmbAdminObjectController
{
  protected $_object_class_name = 'Day';

  function doInteresting()
  {
    $this->items = (new InterestCalculator())->getDaysRatings();
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
    $this->_object_class_name = 'DayInterestRecord';
    return parent::doEdit();
  }

  function doInterestingPin()
  {
    if(!$record = DayInterestRecord::findById($this->request->get('id')))
      return $this->forwardTo404();
    $record->setIsPinned(1);
    $record->save();
    $this->_endDialog();
  }

  function doInterestingUnpin()
  {
    if(!$record = DayInterestRecord::findById($this->request->get('id')))
      return $this->forwardTo404();
    $record->setIsPinned(0);
    $record->save();
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
