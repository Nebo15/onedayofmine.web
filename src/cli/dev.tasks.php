<?php
lmb_require(taskman_prop('PROJECT_DIR') . '/setup.php');

/**
 * @desc Delete all FB test users
 * @mods devel,testing
 *
 */
function task_od_delete_test_users()
{
	$app_id = lmbToolkit::instance()->getConf('facebook')->appId;
	$facebook = lmbToolkit::instance()->getFacebook();

	foreach ($facebook->api("/{$app_id}/accounts/test-users", "GET")['data'] as $facebook_user)
	{
		$facebook_tmp = lmbToolkit::instance()->getFacebook($facebook_user['access_token']);

		if (!$facebook_tmp->api("/{$facebook_user['id']}", "DELETE"))
			exit("Can't delete user!");
		else
			echo "User id='{$facebook_user['id']}' deleted." . PHP_EOL;
	}
}

/**
 * @desc Create FB test users. User avatars should be set manually.
 * @deps od_delete_test_users
 * @mods devel,testing
 */
function task_od_create_test_users()
{
	$app_id = lmbToolkit::instance()->getConf('facebook')->appId;
	$app_scope = lmbToolkit::instance()->getConf('facebook')->permissions;
	$app_scope = implode(',', $app_scope);

	$users = [
		'Foo' => ['id' => null, 'access_token' => null, 'friends' => ['Bar']],
		'Bar' => ['id' => null, 'access_token' => null, 'friends' => ['Foo']],
		'Bill Chengsky' => ['id' => null, 'access_token' => null, 'friends' => []],
		'Joe Qinstein' => ['id' => null, 'access_token' => null, 'friends' => ['Laura Vandervoort']],
		'Laura Vandervoort' => ['id' => null, 'access_token' => null, 'friends' => ['John Doe']],
		'John Doe' => ['id' => null, 'access_token' => null, 'friends' => ['Laura Vandervoort']],
		'Richard Bayers' => ['id' => null, 'access_token' => null, 'friends' => ['Laura Vandervoort', 'John Doe']]
	];

	$facebook = lmbToolkit::instance()->getFacebook();

	foreach ($users as $name => $user)
	{
		echo "Creating user '{$name}'..." . PHP_EOL;
		$url_name = urlencode($name);
		$response = $facebook->api("/{$app_id}/accounts/test-users?installed=true&permissions={$app_scope}&name={$url_name}",
			'POST');
		$users[$name]['id'] = $response['id'];

		echo "Setting '{$name}' password..." . PHP_EOL;
		$response = $facebook->api("/{$response['id']}?password=secret", 'POST');
		if ($response)
			echo "Done." . PHP_EOL . PHP_EOL;
		else
			echo "Failed." . PHP_EOL . PHP_EOL;
	}

	echo "Getting access tokens..." . PHP_EOL;
	$facebook_users = $facebook->api("/{$app_id}/accounts/test-users", "GET")['data'];

	foreach ($users as $name => $user)
	{
		echo "Setting token for '{$name}': ";

		foreach ($facebook_users as $facebook_user)
		{
			if ($user['id'] == $facebook_user['id'])
			{
				$users[$name]['access_token'] = $facebook_user['access_token'];
				break;
			}
		}

		if (!$users[$name]['access_token'])
			exit("User with id='{$user['id']}' not found!");
		else
			echo "Done" . PHP_EOL;
	}
	echo PHP_EOL;

	echo "Creating user relations..." . PHP_EOL;
	foreach ($users as $name => $user)
	{
		$facebook_tmp = lmbToolkit::instance()->getFacebook($user['access_token']);

		foreach ($user['friends'] as $friend)
		{
			echo "'{$name}' wants to add '{$friend}' to friends: ";

			if (!array_key_exists($friend, $users))
				exit('Unknown user in friends list!');
			else
				$friend = $users[$friend];

			if ($facebook_tmp->api("{$user['id']}/friends/{$friend['id']}", 'POST'))
				echo "Done" . PHP_EOL;
			else
				exit("Relation can't be created!");
		}
	}
}

/**
 * @desc Delete all rows from DB tables
 * @mods devel,testing
 */
function task_od_remove_db_data()
{
	lmb_require(taskman_prop('PROJECT_DIR') . 'setup.php');
	lmb_require('tests/src/toolkit/odTestsTools.class.php');

	lmbToolkit::merge(new odTestsTools());
	lmbToolkit::instance()->truncateDb();
}

/**
 * @desc Fill db from lj community
 * @deps migrate_load_all,migrate_run,od_tests_users
 * @mods devel,testing
 * @alias od_fill_from_lj
 */
function task_od_parse_lj($argv)
{
	$app_dir = taskman_prop('PROJECT_DIR');

	lmb_require($app_dir . 'setup.php');
	lmb_require('ljparse/*.class.php');
	lmb_require($app_dir . 'tests/src/odObjectMother.class.php');

	$occupations = array("Bus and Truck Mechanics", "Bus Boy / Bus Girl", "Bus Driver (School)", "Bus Driver (Transit)", "Business Professor", "Business Service Specialist", "Cabinet Maker", "Camp Director", "Caption Writer", "Cardiologist (MD)", "Cardiopulmonary Technologist", "Career Counselor", "Cargo and Freight Agents", "Carpenter's Assistant", "Carpet Installer", "Cartographer (Map Scientist)", "Cartographic Technician", "Cartoonist (Publications)", "Casino Cage Worker", "Casino Cashier", "Casino Dealer", "Casino Floor Person", "Casino Manager", "Casino Pit Boss", "Casino Slot Machine Mechanic", "Casino Surveillance Officer", "Casting Director", "Catering Administrator", "Ceiling Tile Installer", "Cement Mason", "Ceramic Engineer", "Certified Public Accountant (CPA)", "Chaplain (Prison, Military, Hospital)", "Chemical Engineer", "Chemical Equipment Operator", "Chemical Plant Operator", "Chemical Technicians", "Chemistry Professor", "Chief Financial Officer", "Child Care Center Administrator", "Child Care Worker", "Child Life Specialist", "Child Support Investigator", "Child Support Services Worker", "City Planning Aide", "Civil Drafter", "Civil Engineer", "Civil Engineering Technician", "Clergy Member (Religious Leader)", "Clinical Dietitian", "Clinical Psychologist", "Clinical Sociologist", "Coatroom and Dressing Room Attendants", "College/University Professor", "Commercial Designer", "Commercial Diver", "Commercial Fisherman", "Communication Equipment Mechanic", "Communications Professor", "Community Health Nurse", "Community Organization Worker", "Community Welfare Worker", "Compensation Administrator", "Compensation Specialist", "Compliance Officer", "Computer Aided Design (CAD) Technician", "Computer and Information Scientists, Research", "Computer and Information Systems Managers", "Computer Applications Engineer", "Computer Controlled Machine Tool Operators", "Computer Customer Support Specialist", "Computer Hardware Technician", "Computer Operators", "Computer Programmer", "Computer Science Professor");

	$day_comments = array(
		'It was truly wonderful day!', 'I hope to do this once more!', "I've really enjoyed this day", "U jelly?", 'I envy you', "It's really cool. I really appriciate your work", 'Sehr gut.', 'I also want to try this'
	);

	$moment_comments = array(
		'Wow, nice shoot!', "You'r eyes is like the skies!", '*IN LOVE*', 'Take me back!', 'ooh! shiny! :)', 'good idea', 'Beautiful colours in the sky and the heather! The mist in the background adds that special touch :-)', 'Superb shot', 'Excellent landscape shot', 'Really nice, subtle colors. Excellent composition too.', 'Absolutely gorgeous!'
	);

	$locations = array("museum", "park", "coffee shop", "restaurants",
		"bus stop", "city bus", "tram/subway", "city hall",
		"zoo", "school", "grocery store", "library", "hair salon/barber shop",
		"police department", "butcher's shop", "public restrooms", "mall",
		"gas station", "church", "bakery");

	$types = Day::getTypes();

	define('LJ_COMMUNITY_NAME', 'odin-moy-den');
	if (is_array($argv) && count($argv))
		define('POSTS_COUNT', $argv[0]);
	else
		define('POSTS_COUNT', 10);

	echo "Searching for " . POSTS_COUNT . " posts..." . PHP_EOL;
	echo "== Started to search for links... ==" . PHP_EOL;

	$cache = lmbToolkit::instance()->createCacheConnectionByDSN("file:///$app_dir/init/lj_data/");

	$mainPage = new MainPage(new MainPageRegexpParser());
	$contentPageParser = new ContentPageRegexpParser();
	$posts = array();
	for ($i = 1; count($posts) < POSTS_COUNT; $i++)
	{
		echo "{$i}. Parsing posts list..." . PHP_EOL;

		if ($cached_value = $cache->get(LJ_COMMUNITY_NAME . "_page_{$i}"))
			$mainPage->setContent($cached_value);
		else
		{
			$mainPage->getRemoteContent(LJ_COMMUNITY_NAME, $i);
			$cache->set(LJ_COMMUNITY_NAME . "_page_{$i}", $mainPage->getContent());
		}

		$links = $mainPage->getLinksToContentPages();
		$links_count = count($links);
		echo "{$i}. Found {$links_count} posts, parsing them: " . PHP_EOL;
		$j = 0;
		foreach ($links as $post_id)
		{
			$j++;
			$post = new ContentPage($contentPageParser);

			if ($cached_value = $cache->get(LJ_COMMUNITY_NAME . "_post_{$post_id}"))
				$post->setContent($cached_value);
			else
			{
				$post->getRemoteContent(LJ_COMMUNITY_NAME, $post_id);
				$cache->set(LJ_COMMUNITY_NAME . "_post_{$post_id}", $post->getContent());
			}

			if (count($post->getMoments()))
			{
				echo "* {$j}/{$links_count} Found new well-formated post {$post_id}." . PHP_EOL;
				$posts[] = $post;

				if (count($posts) == POSTS_COUNT)
				{
					echo "Posts limit reached, breaking parsing... " . PHP_EOL;
					break 2;
				}
			}
			else
				echo "* {$j}/{$links_count}. Skipping bad-formated post {$post_id}." . PHP_EOL;
		}
	}

	echo "== Found " . count($posts) . " well-formated posts out of {$links_count} possible on {$i} pages. Proccessing them... ==" . PHP_EOL;

	$posts_remain = POSTS_COUNT;
	$tests_users = array();
	lmbArrayHelper::toFlatArray(User::find(), $tests_users);
	shuffle($posts);

	foreach ($posts as $post)
	{
		echo $posts_remain . '. Creating day "' . $post->getTitle() . '":' . PHP_EOL;

		$day = new Day();
		$day->title = $post->getTitle() . ' ' . $posts_remain;
		$day->setUser($tests_users[array_rand($tests_users)]);
		$day->setOccupation($occupations[array_rand($occupations)]);
		$day->setTimezone(0);
		$day->setLocation($locations[array_rand($locations)]);
		$day->setType($types[array_rand($types)]);

		$likes_count = rand(-5, count($tests_users));
		shuffle($tests_users);
		for ($l = 0; $l < $likes_count; $l++)
		{
			$like = new DayLike;
			$like->setDay($day);
			$like->setUser($tests_users[$l]);
			$like->save();
		}

		$day->save();

		$day_comments_count = rand(-3, 3);
		for ($c = 0; $c < $day_comments_count; $c++)
		{
			$day_comment = new DayComment();
			$day_comment->setText($day_comments[array_rand($day_comments)]);
			$day_comment->setDay($day);
			$day_comment->setUser($tests_users[array_rand($tests_users)]);
			$day_comment->save();
		}

		$first = true;
		$time = time() - rand(0, 60 * 60 * 24 * 365);
		$timezone = rand(0, 24) - 12;
		foreach ($post->getMoments() as $moment_data)
		{
			$time += rand(0, 60 * 60);
			if ($first)
			{
				$img_url = $moment_data['img'];
				if (!$cache->get(md5($img_url)))
					$cache->add(md5($img_url), file_get_contents($img_url));
				$day->attachImage($cache->get(md5($img_url)));
				$day->save();
				$first = false;
			}
			$moment = new Moment();
			$moment->setDescription($moment_data['description']);
			$moment->setDay($day);
			$moment->setTimezone($timezone);
			$moment->setTime($time);
			$moment->save();

			$likes_count = rand(-5, count($tests_users));
			shuffle($tests_users);
			for ($l = 0; $l < $likes_count; $l++)
			{
				$like = new MomentLike;
				$like->setMoment($moment);
				$like->setUser($tests_users[$l]);
				$like->save();
			}

			$img_url = $moment_data['img'];
			$img_key = md5($img_url);
			if (!$cache->get($img_key))
			{
				if (!$img_content = od_download_image($img_url, 10))
				{
					echo '-';
					continue;
				}
				$cache->add($img_key, $img_content);
			}

			$moment->attachImage($cache->get($img_key));
			$moment->save();

			$moment_comments_count = rand(-10, 3);
			for ($c = 0; $c < $moment_comments_count; $c++)
			{
				$moment_comment = new MomentComment();
				$moment_comment->setText($moment_comments[array_rand($moment_comments)]);
				$moment_comment->setMoment($moment);
				$moment_comment->setUser($tests_users[array_rand($tests_users)]);
				$moment_comment->save();
			}

			echo ".";
		}

		if (rand(0, 3) < 3)
			$day->final_description = $day_comments[array_rand($day_comments)];

		echo PHP_EOL;
		echo 'Added ' . count($day->getMoments()) . ' moments.' . PHP_EOL;

		$posts_remain--;
	}
}

function od_download_image($url, $attempts)
{
	if (!$attempts)
		return '';

	$ctx = stream_context_create(['http' => ['timeout' => 1]]);
	if (!$content = @file_get_contents($url, 0, $ctx))
		return od_download_image($url, $attempts - 1);
	else
		return $content;
}

/**
 * @desc Register tests users
 * @mods devel,testing
 */
function task_od_tests_users()
{
	lmb_require(taskman_prop('PROJECT_DIR') . 'setup.php');
	lmb_require('tests/src/toolkit/odTestsTools.class.php');

	lmbToolkit :: merge(new odTestsTools());
	$tests_users = lmbToolkit::instance()->getTestsUsers(true);
	array_pop($tests_users); // Foo
	array_pop($tests_users); // Bar
	foreach ($tests_users as $test_user)
	{
		echo "Register '{$test_user->getName()}'...";
		$request = new HttpRequest(lmb_env_get('HOST_URL') . '/auth/login');
		$request->setMethod(HTTP_METH_POST);
		$request->setPostFields(array('token' => $test_user->facebook_access_token));
		$response = $request->send();
		if (200 != $response->getResponseCode())
		{
			var_dump($request->getUrl(), $response);
			exit(1);
		}
		else
		{
			echo 'DONE' . PHP_EOL;
		}
	}

	echo "== Loaded " . count($tests_users) . " test users. ==" . PHP_EOL;
}

/**
 * @mods devel,testing
 */
function task_od_delete_facebook_objects()
{
	lmb_require('tests/src/toolkit/odTestsTools.class.php');

	lmbToolkit :: merge(new odTestsTools());

	function recursive_delete($fb, $url)
	{
		echo "\tUrl: " . $url . PHP_EOL;
		$res = $fb->api($url, "get");
		if (!isset($res['data']))
			return null;
		foreach ($res['data'] as $day)
		{
			echo "\t\tDelete #{$day['id']}...";
			$res = $fb->api('/' . $day['id'] . '?method=delete', 'post');
			echo ($res) ? 'SUCCESS' . PHP_EOL : 'FAILED' . PHP_EOL;
		}
		if (isset($res['paging']['next']))
			recursive_delete($fb, $res['paging']['next']);
	}

	$tests_users = lmbToolkit::instance()->getTestsUsers(true);

//  foreach($tests_users as $test_user)
//  {
//    echo "User: ".$test_user->getName().PHP_EOL;
	$fb = lmbToolkit::instance()->getFacebook($tests_users[6]->facebook_access_token);
	recursive_delete($fb, "/me/one-day-of-mine:add_moment/moment");
	recursive_delete($fb, "/me/one-day-of-mine:add_moment/day");
	recursive_delete($fb, "/me/one-day-of-mine:add_moment");
	recursive_delete($fb, "/me/one-day-of-mine:begin/day");
	recursive_delete($fb, "/me/one-day-of-mine:end/day");
	recursive_delete($fb, "/me/one-day-of-mine:begin");
	recursive_delete($fb, "/me/one-day-of-mine:end");
//  }
}

/**
 * @mods devel,testing
 */
function task_od_siege_log()
{
	lmb_require('tests/src/toolkit/odTestsTools.class.php');
	lmbToolkit :: merge(new odTestsTools());

	define('TEST_FOR_GUEST', 'G');
	define('TEST_FOR_USER', 'U');
	define('TEST_FOR_BOTH', 'B');

	$requests_count = 1000;
	$days_count = 20;
	$moments_count = 400;
	$siege_file = lmb_var_dir() . '/siege.log';

	$paths = [
		['auth/parameters', TEST_FOR_GUEST],
		['days/search?query=:string:', TEST_FOR_GUEST],
		['days/following', TEST_FOR_USER],
		['days/my', TEST_FOR_USER],
		['days/favourite', TEST_FOR_USER],
		['days/types', TEST_FOR_BOTH],
		['moments/:moment_id:/comments/', TEST_FOR_BOTH],
		['my/profile', TEST_FOR_USER],
		['my/settings', TEST_FOR_USER],
		['users/search?query=:string:', TEST_FOR_GUEST],
		['users/:user_id:', TEST_FOR_BOTH],
		['users/:user_id:/days', TEST_FOR_BOTH],
		['users/:user_id:/followers', TEST_FOR_BOTH],
		['users/:user_id:/following', TEST_FOR_BOTH],
		['users/:user_id:/activity', TEST_FOR_BOTH],
	];

	$paths = array_merge($paths, array_fill(0, 19, ['days/new', TEST_FOR_BOTH]));
	$paths = array_merge($paths, array_fill(0, 19, ['days/interesting', TEST_FOR_BOTH]));
	$paths = array_merge($paths, array_fill(0, 39, ['days/:day_id:', TEST_FOR_BOTH]));
	$paths = array_merge($paths, array_fill(0, 5, ['my/news', TEST_FOR_USER]));
	$paths = array_merge($paths, array_fill(0, 3, ['days/:day_id:/comments', TEST_FOR_BOTH]));

	if (file_exists($siege_file))
		unlink($siege_file);

	echo "Clean up db...";
	lmbToolkit::instance()->truncateDb();
	echo "Done" . PHP_EOL;

	$om = new odObjectMother();

	echo "Create users...";
	$users = lmbToolkit::instance()->getTestsUsers();
	$fp = fopen($siege_file, "a");
	foreach ($users as $user)
	{
		$user->save();
		fwrite($fp, lmb_env_get('HOST_URL') . 'auth/login POST token=' . $user->facebook_access_token . PHP_EOL);
	}
	fclose($fp);
	echo "Done" . PHP_EOL;

	echo "Create days...";
	$days_ids = [];
	for ($i = 0; $i < $days_count; $i++)
	{
		$day = $om->dayWithMomentsAndComments();
		$day->day_id = $users[array_rand($users)]->id;
		$day->save();
		$days_ids[] = $day->id;
	}
	echo "Done" . PHP_EOL;

	echo "Create moments...";
	$moments_ids = [];
	for ($i = 0; $i < $moments_count; $i++)
	{
		$moment = $om->moment();
		$moment->day_id = $days_ids[array_rand($days_ids)];
		$moment->save();
		$moments_ids[] = $moment->id;
	}
	echo "Done" . PHP_EOL;

	shuffle($paths);

	$fp = fopen($siege_file, "a");

	for ($i = 0; $i < $requests_count; $i++)
	{
		list($path, $user_type) = $paths[$i % count($paths)];
		$url = $path;

		if (false !== strpos($url, ':string:'))
			$url = str_replace(':string:', md5($i), $url);
		if (false !== strpos($url, ':user_id:'))
			$url = str_replace(':user_id:', $users[array_rand($users)]->id, $url);
		if (false !== strpos($url, ':day_id:'))
			$url = str_replace(':day_id:', $days_ids[array_rand($days_ids)], $url);
		if (false !== strpos($url, ':moment_id:'))
			$url = str_replace(':moment_id:', $moments_ids[array_rand($moments_ids)], $url);

		if (TEST_FOR_BOTH == $user_type)
			$user_type = rand(0, 1) ? TEST_FOR_GUEST : TEST_FOR_USER;

		if (TEST_FOR_USER == $user_type)
			$url .= '?token=' . $users[array_rand($users)]->facebook_access_token;

		$url = lmb_env_get('HOST_URL') . $url;

		fwrite($fp, $url . PHP_EOL);

		echo '.';
	}
	fclose($fp);
}

function task_instagram_test_users($args)
{
	lmb_require('limb/fs/src/lmbFs.class.php');
	$q = new HttpRequest('https://api.instagram.com/v1/tags/chicago/media/recent?access_token=' . $args[0]);
	$photos = json_decode($q->send()->getBody())->data;
	$users = [];

	foreach ($photos as $photo)
	{
		$q = new HttpRequest('https://api.instagram.com/v1/users/' . $photo->user->id . '?access_token=' . $args[0]);
		$user_info = json_decode($q->send()->getBody())->data;
		echo $user_info->username . ' ' . $user_info->id . ' ' . $user_info->counts->media . PHP_EOL;
	}
}

function task_test_analyze($args)
{
	lmb_require('src/service/InstagramPhotosAnalyzer.class.php');

	function _get_photos_recursively($url)
	{
		$request = _request($url);

		if (!isset($request->data))
			var_dump($request);

		$photos = [];
		foreach ($request->data as $raw_photo)
		{
			$photos[$raw_photo->created_time] = $raw_photo;
		}
		if ($request->pagination && property_exists($request->pagination, 'next_url'))
			$photos = $photos + _get_photos_recursively($request->pagination->next_url);
		ksort($photos);
		return $photos;
	}

	function _request($url)
	{
		lmb_require('limb/fs/src/lmbFs.class.php');
		$hash = md5($url);
		$cache_file = lmb_var_dir() . '/importer/' . $hash;
		if (!file_exists($cache_file))
		{
			$request = new HttpRequest();
			$request->setUrl($url);
			$response = $request->send();
			lmbFs::safeWrite($cache_file, serialize($response));
		}
		$content = isset($response) ? $response : unserialize(file_get_contents($cache_file));
		$body = json_decode($content->getBody());
		return $body;
	}

	$photos = _get_photos_recursively('https://api.instagram.com/v1/users/' . $args[1] . '/media/recent/?access_token=' . $args[0]);

	$days = [];
	$current_day = [array_shift($photos)];
	foreach ($photos as $photo)
	{
		$prev_photo = $current_day[count($current_day) - 1];
		if (($photo->created_time - $prev_photo->created_time) < 4 * 60 * 60)
		{
			$current_day[] = $photo;
		}
		else
		{
			if (count($current_day) > 3)
				$days[] = $current_day;
			$current_day = [$photo];
		}
	}

	if (count($current_day) > 3)
		$days[] = [$current_day];

	foreach ($days as $day)
	{
		(new InstagramPhotosAnalyzer($day))->analyze();
	}

	var_dump($days);

	echo 'Days found: '.count($days);
}

function task_import_ical($args)
{
	$events = iCalDecoder($args[0]);
	$holidays = [];
	foreach ($events as $event)
	{
		$year = (int) substr($event->start, 0, 4);
		if($year < 2009 || $year > 2014)
			continue;

		if(!isset($holidays[$event->title]))
			$holidays[$event->title] = [$event->start];
		else
			$holidays[$event->title][] = $event->start;
	}

	echo "\$holidays = [\n";
	foreach($holidays as $name => $dates)
	{
		echo "\t\"$name\" => [\"".implode("\", \"", $dates)."\"],\n";
	}
	echo "];\n";
}

function iCalDecoder($file)
{
	$ical = file_get_contents($file);
	preg_match_all('/(BEGIN:VEVENT.*?END:VEVENT)/si', $ical, $result, PREG_PATTERN_ORDER);
	for ($i = 0; $i < count($result[0]); $i++)
	{
		$tmpbyline = explode(PHP_EOL, $result[0][$i]);

		foreach ($tmpbyline as $item)
		{
			$tmpholderarray = explode(":", $item);
			if (count($tmpholderarray) > 1)
			{
				$majorarray[$tmpholderarray[0]] = $tmpholderarray[1];
			}
		}

		if (preg_match('/DESCRIPTION:(.*)END:VEVENT/si', $result[0][$i], $regs))
			$majorarray['DESCRIPTION'] = str_replace("  ", " ", str_replace("rn", "", $regs[1]));

		$icalarray[] = (object) [
			'title' => trim(str_replace('(US-OPM)', '', $majorarray['SUMMARY'])),
			'category' => $majorarray['CATEGORIES'],
			'start' => $majorarray['DTSTART;VALUE=DATE'],
			'end' => $majorarray['DTEND;VALUE=DATE']
		];
		unset($majorarray);
	}

	return $icalarray;
}
