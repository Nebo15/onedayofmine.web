<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');
lmb_require('src/odStaticObjectMother.class.php');
lmb_require('src/Json.class.php');

abstract class BaseJsonController extends lmbController
{
  /**
   * @var odTools
   */
  protected $toolkit;

  function actionExists($action)
  {
    return (bool) $this->_tryFindGuestMethod($action) || (bool) $this->_tryFindUserMethod($action);
  }

  function performAction()
  {
    if($this->is_forwarded)
      return false;

    $guest_method = $this->_tryFindGuestMethod($this->current_action);
    $user_method = $this->_tryFindUserMethod($this->current_action);
    $is_logged = $this->_isLoggedUser();

    if(!$guest_method && !$user_method)
    {
      return $this->forward('not_found', 'display');
    }
    elseif($guest_method && $user_method)
    {
      $method = $is_logged ? $user_method : $guest_method;
    }
    elseif($guest_method && !$user_method)
    {
      $method = $guest_method;
    }
    elseif(!$guest_method && $user_method)
    {
      $method = $user_method;
      if(!$is_logged)
      {
        $this->response->write($this->_answerUnauthorized());
        return null;
      }
    }

    return $this->_runMethod($method);
  }

  protected function _runMethod($method)
  {
    if($template_path = $this->findTemplateForAction($this->current_action))
      $this->setTemplate($template_path);

    $method_response = $this->$method();

    $this->_passLocalAttributesToView();

    if(is_string($method_response))
      $this->response->write($method_response);
    else
      throw new lmbException("Method '$method' must return a string");

    return $method_response;
  }

  protected function _tryFindGuestMethod($action)
  {
    $method = lmb_camel_case('do_guest_' . $action);
    if(method_exists($this, $method))
      return $method;
    else
      return null;
  }

  protected function _tryFindUserMethod($action)
  {
    $method = lmb_camel_case('do_' . $action);
    if(method_exists($this, $method))
      return $method;

    $method = lmb_camel_case('do_user_' . $action);
    if(method_exists($this, $method))
      return $method;
    else
      return null;
  }

  /**
   * @return User
   */
  protected function _getUser()
  {
    return $this->toolkit->getUser();
  }

  protected function _isLoggedUser()
  {
    return (null != $this->toolkit->getUser()) ? true : false;
  }

  protected function _getFromToLimitations()
  {
    return array(
      $this->request->getFiltered('from', FILTER_SANITIZE_NUMBER_INT),
      $this->request->getFiltered('to', FILTER_SANITIZE_NUMBER_INT),
      $this->request->getFiltered('limit', FILTER_SANITIZE_NUMBER_INT),
    );
  }

  protected function _checkPropertiesInRequest(array $properties)
  {
    foreach($properties as $property)
    {
      if(!$this->request->get($property))
        $this->error_list->addError("Property '$property' not found in request");
    }
    return $this->error_list->export();
  }

  protected function _importSaveAndAnswer($item, array $properties, array $raw_properties = array())
  {
    foreach($properties as $property)
      if($this->request->get($property))
        $item->set($property, $this->request->get($property));

    foreach ($raw_properties as $key => $value)
      $item->set($key, $value);

    $item->validate($this->error_list);
    if($this->error_list->isValid())
    {
      $item->saveSkipValidation();
      $res = $item->exportForApi();

      foreach($res as $key => $property)
        if(is_object($property))
          unset($res[$key]);

      foreach($raw_properties as $key => $property)
        $res->$key = $property;
      return $this->_answerOk($res);
    }
    else
    {
      return $this->_answerWithError($this->error_list->getReadable());
    }
  }

  protected function _answerUnauthorized()
  {
    return $this->_answerWithError('Access allowed only for registered users', null, 401);
  }

  protected function _answerOk($result = null, $status = null, $code = 200)
  {
    if(is_object($result))
    {
      if($result instanceof lmbCollectionInterface)
      {
        $result_array = array();
        foreach($result as $object)
          $result_array[] = $object->exportForApi();
        $result = $result_array;
      }
      elseif($result instanceof BaseModel)
      {
        $result = $result->exportForApi();
      }
    }
    return $this->_answer($result, array(), $status, $code);
  }

  protected function _answerWithError($errors, $status = null, $code = 400)
  {
    if($errors instanceof lmbErrorList)
      $errors = $errors->getReadable();

    if(!is_array($errors))
    {
      if(!$errors)
        throw new lmbException("Error can't be empty");
      $errors = array($errors);
    }
    else
    {
      if(!count($errors))
        throw new lmbException("Error can't be empty");
    }

    return $this->_answer(null, $errors, $status, $code);
  }

  protected function _answerNotFound($message = 'Not Found')
  {
    return $this->_answer($message, array(), $message, 404);
  }

  protected function _answerNotPost($message = 'Not a POST request')
  {
    return $this->_answerWithError($message, null, 405);
  }

  protected function _answer($result, array $errors, $status, $code)
  {
    if($code)
      $this->response->setCode($code);
    if($status)
      $this->response->setStatus($status);

    $this->response->setContentType('application/json');

    return Json::indent(json_encode(
      array(
        'code' => $code,
        'status' => $this->response->getStatus(),
        'result' => $result,
        'errors' => $errors)
    ));
  }

  protected function _attachDayUser(stdClass $day_export, $day)
  {
    $day_export->user = $day->getUser()->exportForApi();
    unset($day_export->user_id);
  }

  protected function _attachDayIsFavorited(stdClass $day_export, $day)
  {
    if(!$user = lmbToolkit::instance()->getUser())
      return null;
    $day_export->is_favourite = DayFavourite::isFavourited($user, $day);
  }

  protected function _attachDayIsDeleted(stdClass $day_export, $day)
  {
    if(!lmbToolkit::instance()->getUser())
      return null;
    if(lmbToolkit::instance()->getUser()->getId() != $day->getUserId())
      return null;
    $day_export->is_deleted = $day->getIsDeleted();
  }

  protected function _attachComments(stdClass $export, Day $day, $only_count = false)
  {
    $comments = $day->getComments();
    $export->comments_count = $comments->count();

    if($only_count)
      return;

    $comments->paginate(0, lmbToolkit::instance()->getConf('common')->default_comments_count);
    $export->comments = array();
    foreach ($comments as $comment) {
      $tmp = $comment->exportForApi();
      $tmp->user = $comment->getUser()->exportForApi();
      unset($tmp->day_id);
      unset($tmp->user_id);
      $export->comments[] = $tmp;
    }
  }

  protected function _attachFinishComment(stdClass $export, Day $day)
  {
    $export->finish_comment = $day->getFinishComment() ? $day->getFinishComment()->exportForApi() : null;
    unset($export->finish_comment->user_id);
    unset($export->finish_comment->day_id);
  }

  protected function _attachDayMoments(stdClass $day_export, $day)
  {
    $day_export->moments = array();
    foreach($day->getMoments() as $moment) {
      $moment_export = $moment->exportForApi();

      // Moment day data
      unset($moment_export->day_id);

      // Moment comments data
      //$this->_attachComments($moment_export, $moment);
      // Comments count
      $moment_export->comments_count = $moment->getComments()->count();

      $day_export->moments[] = $moment_export;
    }
  }

  protected function _exportDayWithSubentities($day)
  {
    $answer = $day->exportForApi();

    // User data
    $this->_attachDayUser($answer, $day);

    // Favorites data
    $this->_attachDayIsFavorited($answer, $day);

    // Comments data
    $this->_attachComments($answer, $day);
    $this->_attachFinishComment($answer, $day);

    // Moments data
    $this->_attachDayMoments($answer, $day);

    return $answer;
  }
}
