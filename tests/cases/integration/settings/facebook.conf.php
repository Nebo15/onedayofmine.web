<?php
require('settings/facebook.conf.php');

odFacebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
odFacebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = false;
