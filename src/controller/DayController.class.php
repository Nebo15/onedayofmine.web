<?php
lmb_require('src/controller/JsonController.class.php');
lmb_require('src/model/Day.class.php');

class DayController extends JsonController
{
  protected $_object_class_name = 'User';

  function doDisplay()
  {
    $result = array();
    lmbArrayHelper::toFlatArray(Day::find(), $result);
    return $result;
  }

  function doItem()
  {
    return Day::findById($this->request->id);
  }

  function doCreate()
  {
    $day = new Day();

    if(!$this->request->hasPost())
      return $this->_answer(null, 405, 'Not a POST request');

    $day->setUser($this->toolkit->getUser());

    return $this->_answer($this->_importAndSave($day, array('title', 'description')));
  }

  function doUpdate()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answer(404, 'Day not found');

    return $this->_importAndSave($day, array('title', 'description'));
  }

  function doDelete()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answer(404, 'Day not found');

    $day->setIsDelete(true);
    $day->save();

    return $day;
  }

  function doRestore()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answer(404, 'Day not found');

    $day->setIsDelete(false);
    $day->save();

    return $day;
  }

  protected function _importAndSave($item, array $properties)
  {
    foreach($properties as $property)
      $item->set($property, $this->request->get($property));

    $item->validate($this->error_list);
    if($this->error_list->isValid())
    {
      $item->saveSkipValidation();
      return $item;
    }
    else
    {
      return $this->error_list->export();
    }
  }
}
