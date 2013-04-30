<?php

lmb_require('src/service/AmazonSNSMailer.class.php');

$conf = array(
	'mailer'                => 'AmazonSNSMailer', //can be lmbFileMailer, lmbResponseMailer
  'sender'                => 'mailman@onedayofmine.com',
  'macro_template_parser' => 'mailpart'
);
