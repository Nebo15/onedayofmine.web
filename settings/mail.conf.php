<?php

$conf = array(
	'mailer'                => 'lmbMailer', //can be lmbFileMailer, lmbResponseMailer
  'use_phpmail'           => false,
  'smtp_host'             => 'localhost',
  'smtp_port'             => 25,
  'smtp_auth'             => false,
  'smtp_user'             => '',
  'smtp_password'         => '',
  'sender'                => 'mailman@onedayofmine.com',
  'macro_template_parser' => 'mailpart'
);
