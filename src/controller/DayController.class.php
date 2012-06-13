<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Day.class.php');

class DayController extends BaseJsonController
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
    return $this->_answerOk(odMock::day());
  }

  function doItems()
  {
    return $this->_answerOk(array(odMock::day(), odMock::day()));
  }

  function doBegin()
  {
    $day = new Day();

    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request', null, 405);

    $day->setUser($this->toolkit->getUser());

    return $this->_importSaveAndAnswer($day, array('title', 'description', 'tags'));
  }

  function doUpdate()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    return $this->_answerOk();

//    if(!$day = Day::findById($this->request->id))
//      return $this->_answerOk(404, 'Day not found');
//
//    return $this->_importSaveAndAnswer($day, array('top_moment_id', 'title', 'description', 'tags'));
  }

  function doEnd()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    return $this->_answerOk();
  }

  function doDelete()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    return $this->_answerOk();

//    if(!$day = Day::findById($this->request->id))
//      return $this->_answerOk(404, 'Day not found');
//
//    $day->setIsDelete(true);
//    $day->save();
//
//    return $day;
  }

  function doRestore()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    return $this->_answerOk();

//    if(!$day = Day::findById($this->request->id))
//      return $this->_answerOk(404, 'Day not found');
//
//    $day->setIsDelete(false);
//    $day->save();
//
//    return $day;
  }

  function doAddMoment()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    return $this->_answerOk();
  }

  function doComment()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    return $this->_answerOk();
  }

  function doShare()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    return $this->_answerOk();
  }

  protected function _importSaveAndAnswer($item, array $properties)
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
      return $this->_answerOk($res);
    }
    else
    {
      return $this->_answerWithError($this->error_list->export());
    }
  }
}
