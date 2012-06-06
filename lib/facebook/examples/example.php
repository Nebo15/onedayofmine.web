<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require '../facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '395096410536617',
  'secret' => '67ffc19dd0fd52d953f92478f4663459',
));

$at = 'AAAFnVo0zuqkBAFH2680ZA1EVuLzaBPGRkYlPxoUMC5unh3MTlozmm2OmIcbDynImVBzRZAZAWbhxD3rGbqmIDhK7X7jFkQlNEbseOIC6IACV0NZAduUZB';

$facebook->setAccessToken($at);

// Get User ID
$userId = $facebook->getUser();

var_dump($facebook->api('/me'));
