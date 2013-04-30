<?php
lmb_require('limb/mail/src/lmbMailer.class.php');

class AmazonSNSMailer extends lmbMailer
{
	function sendHtmlMail($recipients, $subject, $html, $text = null, $charset = 'utf-8')
	{
		if(!is_array($recipients))
			$recipients = [$recipients];
		foreach($recipients as $recipient)
			$this->_send($recipient, $subject, $html);
	}

	function sendPlainMail($recipients, $subject, $body, $charset = 'utf-8')
	{
		if(!is_array($recipients))
			$recipients = [$recipients];
		foreach($recipients as $recipient)
			$this->_send($recipient, $subject, $body);
	}

	function setConfig($config)  {}

	protected function _send($recipient, $subject, $content)
	{
		$toolkit = lmbToolkit::instance();
		$conf = $toolkit->getConf('amazon')->SNS;
		if(!array_key_exists($recipient, $conf['topics']))
			throw new lmbException("Topic for '$recipient' not found. Add them to amazon.conf.php");
		$topic = $conf['topics'][$recipient];
		$response = lmbToolkit::instance()->createAmazonService('SNS')->publish($topic, $content, ['Subject' => $subject]);
		if(!$response->isOK())
			throw new lmbException($response->body);
	}
}