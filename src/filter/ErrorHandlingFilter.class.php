<?php
lmb_require('limb/web_app/src/filter/lmbErrorHandlingFilter.class.php');

class ErrorHandlingFilter extends lmbErrorHandlingFilter
{
  protected function _renderTemplate($error, $params, lmbBacktrace $trace, $file, $line, $context, $request, $session)
  {
    return json_encode(array(
      'error' => $error,
      'params' => $params,
      'file' => $file,
      'line' => $line,
      'request' => $request,
      'session' => $session,
      'trace' => explode(":-)", $trace->toString(":-)")),
    ));
  }

}


