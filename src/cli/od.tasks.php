<?php
/**
 * @desc Remove RemoteApiMock cache
 */
function task_od_remove_cache($argv)
{
  lmb_require('limb/fs/src/lmbFs.class.php');
  lmbFs::rm(taskman_prop('PROJECT_DIR').'/var/facebook_cache');
  lmbFs::rm(taskman_prop('PROJECT_DIR').'/var/twitter_cache');
}

/**
 * @desc Fill db from lj community
 * @deps od_register_tests_users
 */
function task_od_fill_from_lj($argv)
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
  // Returns ~6 posts on page
  define('PAGES', 2);
  define('POSTS_COUNT', 10);

  echo "== Started to search for links... ==".PHP_EOL;

  $mainPage = new MainPage(new MainPageRegexpParser());
  $links_list = array();
  for($i = 1; $i < PAGES+1; $i++)
  {
    $mainPage->getRemoteContent(LJ_COMMUNITY_NAME, $i);
    $links_list = array_merge($links_list, $mainPage->getLinksToContentPages());
    echo $i."/".PAGES.". Total links count: ".count($links_list).".".PHP_EOL;
  }

  echo "== Totally found ".count($links_list)." links on ".PAGES." pages. Proccessing them... ==".PHP_EOL;

	$contentPageParser = new ContentPageRegexpParser();
	$posts = array();
  $i = 0;
  foreach($links_list as $post_id)
  {
    $i++;
    $post = new ContentPage($contentPageParser);
    $post->getRemoteContent(LJ_COMMUNITY_NAME, $post_id);
    if(count($post->getMoments())) {
      echo "{$i}/".count($links_list).". Found new well-formated post {$post_id}.".PHP_EOL;
      $posts[] = $post;
    }
    else
      echo "{$i}/".count($links_list).". Skipping bad-formated post {$post_id}.".PHP_EOL;
  }

  echo "== Found ".count($posts)." well-formated posts on ".PAGES." pages. Proccessing them... ==".PHP_EOL;

  $posts_remain = POSTS_COUNT;
  $tests_users = array();
  lmbArrayHelper::toFlatArray(User::find(), $tests_users);
  while($posts_remain--)
  {
    $post = $posts[array_rand($posts)];

    echo $posts_remain.'. Creating day "'.$post->getTitle().'"...'.PHP_EOL;

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
    foreach($post->getMoments() as $moment_data)
    {
      if($first)
      {
        $day->attachImage('foo.jpg', od_download_file($moment_data['img']));
        $day->save();
        $first = false;
      }
      $moment = new Moment();
      $moment->setDescription($moment_data['description']);
      $moment->setDay($day);
      $moment->save();
      $moment->attachImage('foo.jpg', od_download_file($moment_data['img']));
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
function task_od_register_tests_users($argv)
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

function task_od_calc_interest()
{
  lmb_require(taskman_prop('PROJECT_DIR').'setup.php');
  lmb_require('src/service/InterestCalculator.class.php');

  $calc = new InterestCalculator();
  $calc->deleteUnpinnedDays();
  $calc->fillRating();
}

function od_download_file($url)
{
  $dir = lmb_var_dir().'/parser/';
  $file_path = $dir.md5($url);
  if(!file_exists($file_path))
    lmbFs::safeWrite($file_path, file_get_contents($url));
  return file_get_contents($file_path);
}
