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
    $request_method = $_SERVER['REQUEST_METHOD'];

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

    $server_data = '';
    foreach($_SERVER as $key => $value)
      $server_data .= "<var key=\"$key\">$value</var>";

    if($server_data != '')
      $server_data = "<cgi-data>{$server_data}</cgi-data>";

    $params = '';
    foreach($_GET as $key => $value)
      $params .= "<var key=\"GET[$key]\">$value</var>";

    $params = '';
    foreach($_POST as $key => $value)
      $params .= "<var key=\"POST[$key]\">$value</var>";

    if($params != '')
      $params = "<params>{$params}</params>";

    $session = '';
    if(isset($_SESSION))
      foreach($_SESSION as $key => $value)
        $session .= "<var key=\"$key\">$value</var>";

    if($session != '')
      $session = "<session>{$session}</session>";

//    if(function_exists('fastcgi_finish_request'))
//      fastcgi_finish_request();

    $text = <<<EOD
<?xml version="1.0" encoding="UTF-8"?>
<notice version="2.3">
  <api-key>$airbrake_key</api-key>
  <notifier>
    <name>custom-notifier</name>
    <version>0.0.1</version>
    <url>http://api.onedayofmine.com</url>
  </notifier>
  <error>
    <class>$error_class</class>
    <message>$error_message</message>
    <backtrace>$backtrace</backtrace>
  </error>
  <request>
    <url>$uri</url>
    <action>$request_method</action>
    <component/>
    $params
    $session
    $server_data
  </request>
  <server-environment>
    <project-root>/</project-root>
    <environment-name>$env</environment-name>
  </server-environment>
</notice>
EOD;
    $request = new HttpRequest(
      'http://api.airbrake.io/notifier_api/v2/notices', HttpRequest::METH_POST
    );
    $request->setBody($text);
    $request->send();
  }
}
