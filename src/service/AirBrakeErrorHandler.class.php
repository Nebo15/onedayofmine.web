<?php
class AirBrakeErrorHandler
{
	static function onError($type, $message, $file, $line)
	{
		$backtrace = "<line method=\"\" file=\"{$file}\" number=\"{$line}\"/>".PHP_EOL;;
		self::_send('Error ('.$type.')', $message, $backtrace);
	}

	static function onException(Exception $e)
	{
		$error_class = get_class($e);
		$error_message = ($e instanceof lmbException) ? $e->getOriginalMessage() : $e->getMessage();

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

		self::_send($error_class, $error_message, $backtrace);
	}

	protected static function _send($type, $message, $backtrace)
  {
    $airbrake_key = lmb_env_get('AIRBRAKE_KEY');
	  $uri = isset($_SERVER['REQUEST_URI']) ? 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : 'cli';
	  $env = lmb_app_mode();

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
    <class>{$type}</class>
    <message>{$message}</message>
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
    }
  }

  protected static function arrayToXMLVarList(array $array, $key_prefix='')
  {
    $result = '';

    foreach ($array as $key => $value)
    {
      if(is_object($value))
        $value = json_encode((array) $value);

      $key = $key_prefix ? "{$key_prefix}[{$key}]" : $key;

      if(is_array($value))
        $result .= self::arrayToXMLVarList($value, $key);
      else
      {
        $result .= "<var key=\"{$key}\">{$value}</var>";
      }
    }

    return $result;
  }
}
