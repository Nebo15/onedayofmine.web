<?php
class AirBrakeErrorHandler
{
  static function onException(Exception $e)
  {
    $airbrake_key = lmb_env_get('AIRBRAKE_KEY');
    $error_class = get_class($e);
    $error_message = ($e instanceof lmbException) ? $e->getOriginalMessage() : $e->getMessage();
    $uri = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : 'cli';
    $env = lmb_app_mode();

    $backtrace = '';
    foreach($e->getTrace() as $trace)
    {
      $method = '';
      if(isset($trace['class']))
        $method .= $trace['class'].'::';
      if(isset($trace['function']))
        $method .= $trace['function']."()";
      if(isset($trace['file'], $trace['line']))
        $backtrace .= "<line method=\"{$method}\" file=\"{$trace['file']}\" number=\"{$trace['line']}\"/>".PHP_EOL;
    }

    $server_xml_variables  = self::arrayToXMLVarList($_SERVER);
    $server_xml_variables  = $server_xml_variables ? "<cgi-data>{$server_xml_variables}</cgi-data>" : '';

    $get_xml_variables     = self::arrayToXMLVarList($_GET, 'GET');
    $post_xml_variables    = self::arrayToXMLVarList($_POST, 'POST');
    $params_xml_variables  = $post_xml_variables ? "<params>{$post_xml_variables}</params>" : '';

    if(isset($_SESSION))
    {
      $session_xml_variables = self::arrayToXMLVarList($_SESSION);
      $session_xml_variables = $session_xml_variables ? "<session>{$session_xml_variables}</session>" : '';
    }
    else
      $session_xml_variables = '';

    try
    {
      $request = lmbToolkit::instance()->getRequest();
      $controller = '<component>'.$request->controller.'</component>';
      $action     = '<action>'.$request->action.'</action>';
    }
    catch (Exception $e)
    {
      $controller = '<component/>';
      $action     = '<action/>';
    }

    $text = <<<EOD
<?xml version="1.0" encoding="UTF-8"?>
<notice version="2.3">
  <api-key>{$airbrake_key}</api-key>
  <notifier>
    <name>custom-notifier</name>
    <version>0.0.1</version>
    <url>http://api.onedayofmine.com</url>
  </notifier>
  <error>
    <class>{$error_class}</class>
    <message>{$error_message}</message>
    <backtrace>{$backtrace}</backtrace>
  </error>
  <request>
    <url>{$uri}</url>
    {$action}
    {$controller}
    {$params_xml_variables}
    {$session_xml_variables}
    {$server_xml_variables}
  </request>
  <server-environment>
    <project-root>/</project-root>
    <environment-name>{$env}</environment-name>
  </server-environment>
</notice>
EOD;
    $request = new HttpRequest(
      'http://api.airbrake.io/notifier_api/v2/notices', HttpRequest::METH_POST
    );
    $request->setBody($text);
    $request->send();

    if($request->getResponseCode() != 200)
    {
      lmbToolkit::instance()
        ->getLog()
        ->error("AirBrake returned HTTP ".$request->getResponseCode(), ['response_body' => $request->getResponseBody()]);

      self::showErrorPage('Critical error occurred. If this keeps happening for long perion of time email us at support@onedayofmine.com.');
    }
    else
      self::showErrorPage();
  }

  protected static function arrayToXMLVarList(array $array, $key_prefix='')
  {
    $result = '';

    foreach ($array as $key => $value) {
      $key = $key_prefix ? "{$key_prefix}[{$key}]" : $key;

      if(is_array($value))
        $result .= self::arrayToXMLVarList($value, $key);
      else
        $result .= "<var key=\"{$key}\">{$value}</var>";
    }

    return $result;
  }

  protected static function showErrorPage($message = 'Critical error occurred. We recieved notification about it, and we will fix it shortly.')
  {
    header('HTTP/1.x 500 Server Error');
    header('Content-Type: application/json');

    echo json_encode([
      'code'   => 500,
      'status' => 'Internal error',
      'result' => null,
      'errors' => [$message],
    ]);
  }
}
