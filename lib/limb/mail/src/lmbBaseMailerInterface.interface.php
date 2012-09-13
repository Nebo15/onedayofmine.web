<?php

interface lmbBaseMailerInterface
{
  function sendHtmlMail($recipients, $subject, $html, $text = null, $charset = 'utf-8');
  function sendPlainMail($recipients, $subject, $body, $charset = 'utf-8');
  function setConfig($config);
}
