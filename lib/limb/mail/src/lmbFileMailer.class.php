<?php

lmb_require('limb/mail/src/lmbMailer.class.php');

class lmbFileMailer extends lmbMailer
{
  function sendHtmlMail($recipients, $subject, $html, $text = null, $charset = 'utf-8')
  {
    $content =<<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /></head>
<body>
EOD;
    $content .= '<p>recipient: '.$recipients.'</p>';
    $content .= '<p>sender: '.$this->sender.'</p>';
    $content .= '<p>subject: '.$subject.'</p>';
	  $content .= '<p>charset: '.$charset.'</p>';
    $content .= '<pre>html: '.$html.'</pre>';
    $content .= '<pre>text: '.$text.'</pre>';

    $content .= '</body></html>';

    $this->_send($recipients, $subject, $content, 'html');
  }

  function sendPlainMail($recipients, $subject, $body, $charset = 'utf-8')
  {
    $content = '';
    $content .= 'recipient: '.$recipients.PHP_EOL;
    $content .= 'sender: '.$this->sender.PHP_EOL;
    $content .= 'subject: '.$subject.PHP_EOL;
    $content .= 'text: '.$body.PHP_EOL;
    $content .= 'charset: '.$charset.PHP_EOL;

    $this->_send($recipients, $subject, $content, 'txt');
  }

  function setConfig($config)  {}
    
  protected function _send($recipients, $subject, $content, $ext)
  {
    lmbFs::safeWrite(lmb_env_get('LIMB_VAR_DIR').'/mail/'.$recipients.'_'.$subject.'.'.$ext, $content);
  }
}