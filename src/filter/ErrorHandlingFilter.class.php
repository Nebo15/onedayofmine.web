<?php
lmb_require('limb/web_app/src/filter/lmbErrorHandlingFilter.class.php');

class ErrorHandlingFilter extends lmbErrorHandlingFilter
{
  protected function _renderTemplate($error, $params, lmbBacktrace $trace, $file, $line, $context, $request, $session)
  {
    header('HTTP/1.x 500 Server Error');
    header('Content-Type: application/json');

    return json_encode(array(
      'result' => null,
      'code' => 500,
      'status' => 'Internal error',
      'errors' => $error,
      'file' => $file,
      'line' => $line
    ));
  }

  function _echoErrorPage()
  {
    header('HTTP/1.x 500 Server Error');
    header('Content-Type: application/json');

    echo json_encode(array(
      'code' => 500,
      'status' => 'Internal error',
      'result' => null,
      'errors' => array('Critical error occurred.'),
    ));
  }
}


