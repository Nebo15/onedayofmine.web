<?php
lmb_require('limb/web_app/src/filter/lmbErrorHandlingFilter.class.php');

class ErrorHandlingFilter extends lmbErrorHandlingFilter
{  
  protected function _renderTemplate($error, $params, lmbBacktrace $trace, $file, $line, $context, $request, $session)
  {
    $json = json_encode(array(
      'error' => $error,
      'params' => $params,
      'trace' => $trace->toString(PHP_EOL),
      'file' => $file,
      'line' => $line,
      'context' => $context,
      'request' => $request,
      'session' => $session
    ));
    $pattern = array(',"', '{', '}', '\n');
    $replacement = array(",\n\t\"", "{\n\t", "\n}", '\n'.PHP_EOL);
    return str_replace($pattern, $replacement, $json);    
  }
  
}


