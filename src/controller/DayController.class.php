<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Day.class.php');

class DayControllerBase extends BaseJsonController
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
    return Day::findById($this->request->id)->exportToSimpleObj();
  }

  function doBegin()
  {
    $day = new Day();

    if(!$this->request->hasPost())
      return $this->_answerOk(null, 405, 'Not a POST request');

    $day->setUser($this->toolkit->getUser());

    return $this->_answerOk($this->_importAndSave($day, array('title', 'description')));
  }

  function doUpdate()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerOk(404, 'Day not found');

    return $this->_importAndSave($day, array('title', 'description'));
  }

  function doEnd()
  {

  }

  function doDelete()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerOk(404, 'Day not found');

    $day->setIsDelete(true);
    $day->save();

    return $day;
  }

  function doRestore()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerOk(404, 'Day not found');

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
      $res = $item->export();
      foreach($res as $key => $property)
        if(is_object($property))
          unset($res[$key]);
      return $res;
    }
    else
    {
      return $this->error_list->export();
    }
  }
}
