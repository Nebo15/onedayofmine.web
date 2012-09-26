<?php
lmb_require(taskman_prop('PROJECT_DIR').'/setup.php');

if(extension_loaded('newrelic'))
  newrelic_background_job(true);

/**
 * @desc Delete all FB test users
 * @mods devel,testing
 */
function task_od_delete_test_users()
{
  $app_id    = lmbToolkit::instance()->getConf('facebook')->appId;
  $facebook = lmbToolkit::instance()->getFacebook();

  foreach ($facebook->api("/{$app_id}/accounts/test-users", "GET")['data'] as $facebook_user) {
    $facebook_tmp = lmbToolkit::instance()->getFacebook($facebook_user['access_token']);

    if(!$facebook_tmp->api("/{$facebook_user['id']}", "DELETE"))
      exit("Can't delete user!");
    else
      echo "User id='{$facebook_user['id']}' deleted.".PHP_EOL;
  }
}

/**
 * @desc Create FB test users. User avatars should be set manually.
 * @deps od_delete_test_users
 * @mods devel,testing
 */
function task_od_create_test_users()
{
  $app_id    = lmbToolkit::instance()->getConf('facebook')->appId;
  $app_scope = lmbToolkit::instance()->getConf('facebook')->permissions;
  $app_scope = implode(',', $app_scope);

  $users = [
    'Foo'               => ['id' => null, 'access_token' => null, 'friends' => ['Bar']],
    'Bar'               => ['id' => null, 'access_token' => null, 'friends' => ['Foo']],
    'Bill Chengsky'     => ['id' => null, 'access_token' => null, 'friends' => []],
    'Joe Qinstein'      => ['id' => null, 'access_token' => null, 'friends' => ['Laura Vandervoort']],
    'Laura Vandervoort' => ['id' => null, 'access_token' => null, 'friends' => ['John Doe']],
    'John Doe'          => ['id' => null, 'access_token' => null, 'friends' => ['Laura Vandervoort']],
    'Richard Bayers'    => ['id' => null, 'access_token' => null, 'friends' => ['Laura Vandervoort', 'John Doe']]
  ];

  $facebook = lmbToolkit::instance()->getFacebook();

  foreach ($users as $name => $user) {
    echo "Creating user '{$name}'...".PHP_EOL;
    $url_name = urlencode($name);
    $response = $facebook->api("/{$app_id}/accounts/test-users?installed=true&permissions={$app_scope}&name={$url_name}", 'POST');
    $users[$name]['id'] = $response['id'];

    echo "Setting '{$name}' password...".PHP_EOL;
    $response = $facebook->api("/{$response['id']}?password=secret", 'POST');
    if($response)
      echo "Done.".PHP_EOL.PHP_EOL;
    else
      echo "Failed.".PHP_EOL.PHP_EOL;
  }

  echo "Getting access tokens...".PHP_EOL;
  $facebook_users = $facebook->api("/{$app_id}/accounts/test-users", "GET")['data'];

  foreach ($users as $name => $user) {
    echo "Setting token for '{$name}': ";

    foreach ($facebook_users as $facebook_user) {
      if($user['id'] == $facebook_user['id']) {
        $users[$name]['access_token'] = $facebook_user['access_token'];
        break;
      }
    }

    if(!$users[$name]['access_token'])
      exit("User with id='{$user['id']}' not found!");
    else
      echo "Done".PHP_EOL;
  }
  echo PHP_EOL;

  echo "Creating user relations...".PHP_EOL;
  foreach ($users as $name => $user) {
    $facebook_tmp = lmbToolkit::instance()->getFacebook($user['access_token']);

    foreach ($user['friends'] as $friend) {
      echo "'{$name}' wants to add '{$friend}' to friends: ";

      if(!array_key_exists($friend, $users))
        exit('Unknown user in friends list!');
      else
        $friend = $users[$friend];

      if($facebook_tmp->api("{$user['id']}/friends/{$friend['id']}", 'POST'))
        echo "Done".PHP_EOL;
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
  lmb_require(taskman_prop('PROJECT_DIR').'setup.php');
  lmb_require('tests/src/toolkit/odTestsTools.class.php');

  lmbToolkit::merge(new odTestsTools());
  lmbToolkit::instance()->truncateTablesOf(
    'Complaint',
    'Day', 'DayComment', 'DayFavorite', 'DayInterestRecord',
    'Moment',  'MomentComment',
    'News',
    'User', 'UserFollowing', 'UserSettings');
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

  lmb_require($app_dir.'setup.php');
  lmb_require('ljparse/*.class.php');
  lmb_require($app_dir.'tests/src/odObjectMother.class.php');

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
  if(is_array($argv) && count($argv))
    define('POSTS_COUNT', $argv[0]);
  else
    define('POSTS_COUNT', 10);

  echo "Searching for ".POSTS_COUNT." posts...".PHP_EOL;
  echo "== Started to search for links... ==".PHP_EOL;

  $cache = lmbToolkit::instance()->createCacheConnectionByDSN("file:///$app_dir/init/lj_data/");

  $mainPage = new MainPage(new MainPageRegexpParser());
  $contentPageParser = new ContentPageRegexpParser();
  $posts = array();
  for($i = 1; count($posts) < POSTS_COUNT; $i++)
  {
    echo "{$i}. Parsing posts list...".PHP_EOL;

    if($cached_value = $cache->get(LJ_COMMUNITY_NAME."_page_{$i}"))
      $mainPage->setContent($cached_value);
    else {
      $mainPage->getRemoteContent(LJ_COMMUNITY_NAME, $i);
      $cache->set(LJ_COMMUNITY_NAME."_page_{$i}", $mainPage->getContent());
    }

    $links = $mainPage->getLinksToContentPages();
    $links_count = count($links);
    echo "{$i}. Found {$links_count} posts, parsing them: ".PHP_EOL;
    $j = 0;
    foreach($links as $post_id)
    {
      $j++;
      $post = new ContentPage($contentPageParser);

      if($cached_value = $cache->get(LJ_COMMUNITY_NAME."_post_{$post_id}"))
        $post->setContent($cached_value);
      else {
        $post->getRemoteContent(LJ_COMMUNITY_NAME, $post_id);
        $cache->set(LJ_COMMUNITY_NAME."_post_{$post_id}", $post->getContent());
      }

      if(count($post->getMoments())) {
        echo "* {$j}/{$links_count} Found new well-formated post {$post_id}.".PHP_EOL;
        $posts[] = $post;

        if(count($posts) == POSTS_COUNT) {
          echo "Posts limit reached, breaking parsing... ".PHP_EOL;
          break 2;
        }
      }
      else
        echo "* {$j}/{$links_count}. Skipping bad-formated post {$post_id}.".PHP_EOL;
    }
  }

  echo "== Found ".count($posts)." well-formated posts out of {$links_count} possible on {$i} pages. Proccessing them... ==".PHP_EOL;

  $posts_remain = POSTS_COUNT;
  $tests_users = array();
  lmbArrayHelper::toFlatArray(User::find(), $tests_users);
  shuffle($posts);

  foreach ($posts as $post) {
    echo $posts_remain.'. Creating day "'.$post->getTitle().'":'.PHP_EOL;

    $day = new Day();
    $day->setTitle($post->getTitle().' '.$posts_remain);
    $day->setUser($tests_users[array_rand($tests_users)]);
    $day->setOccupation($occupations[array_rand($occupations)]);
    $day->setTimezone(0);
    $day->setLocation($locations[array_rand($locations)]);
    $day->setType($types[array_rand($types)]);

    $likes_count = rand(-5, count($tests_users));
    shuffle($tests_users);
    for ($l=0; $l < $likes_count; $l++) {
      $like = new DayLike;
      $like->setDay($day);
      $like->setUser($tests_users[$l]);
      $like->save();
    }

    $day->save();

    $day_comments_count = rand(-3, 3);
    for($c = 0; $c < $day_comments_count; $c++)
    {
      $day_comment = new DayComment();
      $day_comment->setText($day_comments[array_rand($day_comments)]);
      $day_comment->setDay($day);
      $day_comment->setUser($tests_users[array_rand($tests_users)]);
      $day_comment->save();
    }

    $first = true;
    $time = time()-rand(0, 60*60*24*365);
    $timezone = rand(0,24)-12;
    foreach($post->getMoments() as $moment_data)
    {
      $time += rand(0, 60*60);
      if($first)
      {
        $img_url = $moment_data['img'];
        if(!$cache->get(md5($img_url)))
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
      for ($l=0; $l < $likes_count; $l++) {
        $like = new MomentLike;
        $like->setMoment($moment);
        $like->setUser($tests_users[$l]);
        $like->save();
      }

      $img_url = $moment_data['img'];
      if(!$cache->get(md5($img_url)))
        $cache->add(md5($img_url), file_get_contents($img_url));
      $moment->attachImage($cache->get(md5($img_url)));
      $moment->save();

      $moment_comments_count = rand(-10, 3);
      for($c = 0; $c < $moment_comments_count; $c++)
      {
        $moment_comment = new MomentComment();
        $moment_comment->setText($moment_comments[array_rand($moment_comments)]);
        $moment_comment->setMoment($moment);
        $moment_comment->setUser($tests_users[array_rand($tests_users)]);
        $moment_comment->save();
      }

      echo ".";
    }

    if(rand(0, 3) < 3)
      $day->setFinalDescription($day_comments[array_rand($day_comments)]);

    echo PHP_EOL;
    echo 'Added '. count($day->getMoments()) .' moments.'.PHP_EOL;

    $posts_remain--;
  }
}

/**
 * @desc Register tests users
 * @mods devel,testing
 */
function task_od_tests_users()
{
  lmb_require(taskman_prop('PROJECT_DIR').'setup.php');
  lmb_require('tests/src/toolkit/odTestsTools.class.php');

  lmbToolkit :: merge(new odTestsTools());
  $tests_users = lmbToolkit::instance()->getTestsUsers(true);
  array_pop($tests_users); // Foo
  array_pop($tests_users); // Bar
  foreach($tests_users as $test_user)
  {
    echo "Register '{$test_user->getName()}'...";
    $request = new HttpRequest(lmb_env_get('HOST_URL').'/auth/login');
    $request->setMethod(HTTP_METH_POST);
    $request->setPostFields(array('token' => $test_user->getFacebookAccessToken()));
    $response = $request->send();
    if(200 != $response->getResponseCode())
    {
      var_dump($response);
      exit(1);
    }
    else
    {
      echo 'DONE'.PHP_EOL;
    }
  }

  echo "== Loaded ".count($tests_users)." test users. ==".PHP_EOL;
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
    echo "\tUrl: ".$url.PHP_EOL;
    $res = $fb->api($url, "get");
    if(!isset($res['data']))
      return null;
    foreach($res['data'] as $day)
    {
      echo "\t\tDelete #{$day['id']}...";
      $res = $fb->api('/'.$day['id'].'?method=delete', 'post');
      echo ($res) ? 'SUCCESS'.PHP_EOL : 'FAILED'.PHP_EOL;
    }
    if(isset($res['paging']['next']))
      recursive_delete($fb, $res['paging']['next']);
  }

  $tests_users = lmbToolkit::instance()->getTestsUsers(true);

//  foreach($tests_users as $test_user)
//  {
//    echo "User: ".$test_user->getName().PHP_EOL;
    $fb = lmbToolkit::instance()->getFacebook($tests_users[6]->getFacebookAccessToken());
    recursive_delete($fb, "/me/one-day-of-mine:add_moment/moment");
    recursive_delete($fb, "/me/one-day-of-mine:add_moment/day");
    recursive_delete($fb, "/me/one-day-of-mine:add_moment");
    recursive_delete($fb, "/me/one-day-of-mine:begin/day");
    recursive_delete($fb, "/me/one-day-of-mine:end/day");
    recursive_delete($fb, "/me/one-day-of-mine:begin");
    recursive_delete($fb, "/me/one-day-of-mine:end");
//  }
}
