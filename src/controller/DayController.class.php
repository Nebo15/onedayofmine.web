<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/DayTest.class.php');

class DayController extends BaseJsonController
{
  protected $_object_class_name = 'User';

  function doItem()
  {
    $id = $this->request->get('id');
    $day = Day::findById($id);
    if($day && !$day->getIsDeleted())
    {
      $answer = $day->exportForApi();
      $answer->moments = array();
      foreach($day->getMoments() as $moment)
        $answer->moments[] = $moment->exportForApi();
      return $this->_answerOk($answer);
    }
    else
      return $this->_answerNotFound("Day with id='$id' not found");
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

    return $this->_importSaveAndAnswer($day, array('title', 'description', 'tags', 'time_offset'));
  }

  function doUpdate()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    return $this->_answerOk();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerOk(404, 'Day not found');

    return $this->_importSaveAndAnswer($day, array('title', 'description', 'tags', 'time_offset'));
  }

  function doEnd()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    return $this->_answerOk(odMock::day());
  }

  function doDelete()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    return $this->_answerOk();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerOk(404, 'Day not found');

    $day->setIsDelete(true);
    $day->save();

    return $day;
  }

  function doAddMoment()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    $errors = $this->_checkPropertiesExists(array('day_id', 'description', 'image_name', 'image_content'));
    if(count($errors))
      return $this->_answerWithError($errors);

    if(!$day = Day::findById($this->request->get('day_id')))
      return $this->_answerWithError("Day not found by id");

    $moment = new Moment();
    $moment->setDay($day);
    $moment->setDescription($this->request->get('description'));
    $moment->save();
    $moment->attachImage(
      $this->request->get('image_name'),
      base64_decode($this->request->get('image_content'))
    );
    $moment->save();

    if($this->error_list->isEmpty())
      return $this->_answerOk($moment->exportForApi());
    else
      return $this->_answerWithError($this->error_list->export());
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

  protected function _checkPropertiesExists(array $properties)
  {
    foreach($properties as $property)
    {
      if(!$this->request->has($property))
        $this->addError("Property '$property' not found in request");
    }
    return $this->error_list;
  }
}
