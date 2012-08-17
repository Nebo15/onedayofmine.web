<?php
lmb_require(taskman_prop('PROJECT_DIR').'setup.php');

/**
 * @desc Delete all rows from DB tables
 */
function task_od_remove_db_data()
{
  lmb_require(taskman_prop('PROJECT_DIR').'setup.php');
  lmb_require('tests/src/toolkit/odTestsTools.class.php');

  lmbToolkit::merge(new odTestsTools());
  lmbToolkit::instance()->truncateTablesOf(
    'Complaint',
    'Day', 'DayComment', 'DayFavourite', 'DayInterestRecord',
    'Moment',  'MomentComment',
    'News',
    'User', 'UserFollowing', 'UserSettings');
}

/**
 * @desc Fill db from lj community
 * @deps od_tests_users
 * @alias od_fill_from_lj
 */
function task_od_parse_lj($argv)
{
  $app_dir = taskman_prop('PROJECT_DIR');

  lmb_require($app_dir.'setup.php');
  lmb_require('ljparse/*.class.php');
  lmb_require($app_dir.'tests/src/odObjectMother.class.php');

  $occupations = array("Bus and Truck Mechanics", "Bus Boy / Bus Girl", "Bus Driver (School)", "Bus Driver (Transit)", "Business Professor", "Business Service Specialist", "Cabinet Maker", "Camp Director", "Caption Writer", "Cardiologist (MD)", "Cardiopulmonary Technologist", "Career Counselor", "Cargo and Freight Agents", "Carpenter's Assistant", "Carpet Installer", "Cartographer (Map Scientist)", "Cartographic Technician", "Cartoonist (Publications)", "Casino Cage Worker", "Casino Cashier", "Casino Dealer", "Casino Floor Person", "Casino Manager", "Casino Pit Boss", "Casino Slot Machine Mechanic", "Casino Surveillance Officer", "Casting Director", "Catering Administrator", "Ceiling Tile Installer", "Cement Mason", "Ceramic Engineer", "Certified Public Accountant (CPA)", "Chaplain (Prison, Military, Hospital)", "Chemical Engineer", "Chemical Equipment Operator", "Chemical Plant Operator", "Chemical Technicians", "Chemistry Professor", "Chief Financial Officer", "Child Care Center Administrator", "Child Care Worker", "Child Life Specialist", "Child Support Investigator", "Child Support Services Worker", "City Planning Aide", "Civil Drafter", "Civil Engineer", "Civil Engineering Technician", "Clergy Member (Religious Leader)", "Clinical Dietitian", "Clinical Psychologist", "Clinical Sociologist", "Coatroom and Dressing Room Attendants", "College/University Professor", "Commercial Designer", "Commercial Diver", "Commercial Fisherman", "Communication Equipment Mechanic", "Communications Professor", "Community Health Nurse", "Community Organization Worker", "Community Welfare Worker", "Compensation Administrator", "Compensation Specialist", "Compliance Officer", "Computer Aided Design (CAD) Technician", "Computer and Information Scientists, Research", "Computer and Information Systems Managers", "Computer Applications Engineer", "Computer Controlled Machine Tool Operators", "Computer Customer Support Specialist", "Computer Hardware Technician", "Computer Operators", "Computer Programmer", "Computer Science Professor");

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
  while($posts_remain--)
  {
    $post = $posts[array_rand($posts)];

    echo $posts_remain.'. Creating day "'.$post->getTitle().'":'.PHP_EOL;

    $day = new Day();
    $day->setTitle($post->getTitle().' '.$posts_remain);
    $day->setUser($tests_users[array_rand($tests_users)]);
    $day->setOccupation($occupations[array_rand($occupations)]);
    $day->setTimezone(0);
    $day->setLocation($locations[array_rand($locations)]);
    $day->setType($types[array_rand($types)]);
    $day->setLikesCount(rand(1, 100));
    $day->save();

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
      $img_url = $moment_data['img'];
      if(!$cache->get(md5($img_url)))
        $cache->add(md5($img_url), file_get_contents($img_url));
      $moment->attachImage($cache->get(md5($img_url)));
      $moment->save();
      echo ".";
    }
    echo PHP_EOL;
    echo 'Added '. count($day->getMoments()) .' moments.'.PHP_EOL;
  }
}

/**
 * @desc Register tests users
 * @deps od_remove_cache
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
    $request->setPostFields(array('token' => $test_user->getFbAccessToken()));
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

function task_od_delete_fb_objects()
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
    $fb = lmbToolkit::instance()->getFacebook($tests_users[6]->getFbAccessToken());
    recursive_delete($fb, "/me/one-day-of-mine:add_moment/moment");
    recursive_delete($fb, "/me/one-day-of-mine:add_moment/day");
    recursive_delete($fb, "/me/one-day-of-mine:add_moment");
    recursive_delete($fb, "/me/one-day-of-mine:begin/day");
    recursive_delete($fb, "/me/one-day-of-mine:end/day");
    recursive_delete($fb, "/me/one-day-of-mine:begin");
    recursive_delete($fb, "/me/one-day-of-mine:end");
//  }
}

