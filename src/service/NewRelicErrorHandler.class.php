<?php
class NewRelicErrorHandler
{
	static function onFatalError($type, $message, $file, $line)
	{
		newrelic_notice_error($message.' in '.$file.':'.$line);
	}

	static function onException($e)
	{
		$error_message = ($e instanceof lmbException) ? $e->getOriginalMessage() : $e->getMessage();
		newrelic_notice_error($error_message, $e);
	}
}
