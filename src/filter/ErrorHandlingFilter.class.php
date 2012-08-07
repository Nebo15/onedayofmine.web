<?php
lmb_require('limb/web_app/src/filter/lmbErrorHandlingFilter.class.php');

class ErrorHandlingFilter extends lmbErrorHandlingFilter
{
  protected function _renderTemplate($error, $params, lmbBacktrace $trace, $file, $line, $context, $request, $session)
  {
    return json_encode(array(
      'result' => null,
      'code' => 500,
      'status' => 'Internal error',
      'errors' => $error,
      'file' => $file,
      'line' => $line
    ));
  }

}


