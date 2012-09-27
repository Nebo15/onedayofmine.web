<?php

$mysqli = new mysqli("localhost", "root", "", "one_day");
if ($mysqli->connect_errno) {
  die("Connect failed: ".$mysqli->connect_error.PHP_EOL);
}
if(!$result = $mysqli->query("SELECT * FROM day WHERE is_deleted = 0 ORDER BY id DESC LIMIT 100"))
  die($mysqli->error.PHP_EOL);
//$result = $mysqli->query("SELECT day_id, COUNT(id) as count FROM day_like GROUP BY day_id");
$rows = $result->fetch_all(MYSQLI_ASSOC);
$result->close();

$users_ids = [];
$days_ids = [];
$days = [];
foreach($rows as $row)
{
  $days_ids[] = $row['id'];
  $users_ids[$row['user_id']] = $row['user_id'];

  $export = new stdClass();
  $export->id = $row['id'];
  $export->user_id = $row['user_id'];
  $export->type = $row['type'];
  $export->title = $row['title'];
  $export->image_266 = null;
  $export->image_532 = null;
  $export->final_description = $row['final_description'];
  $export->views_count = $row['views_count'] ?: 0;
  $export->likes_count = $row['views_count'] ?: 0;
  $export->comments_count = $row['views_count'] ?: 0;

  $days[$row['id']] = $export;
}
$days_ids = implode(',', $days_ids);

if(!$result = $mysqli->query("SELECT day_id, COUNT(id) as count FROM day_like WHERE day_id IN ({$days_ids}) GROUP BY day_id"))
  die($mysqli->error.PHP_EOL);
$rows = $result->fetch_all();
$result->close();
foreach($rows as $row)
  $days[$row['days_id']]->likes_count = isset($days[$row['days_id']]) ? $row['count'] : 0;

if(!$result = $mysqli->query("SELECT day_id, COUNT(id) as count FROM day_comment WHERE day_id IN ({$days_ids}) GROUP BY day_id"))
  die($mysqli->error.PHP_EOL);
$rows = $result->fetch_all();
$result->close();
foreach($rows as $row)
  $days[$row['days_id']]->comments_count = isset($days[$row['days_id']]) ? $row['count'] : 0;

$users_ids = implode(',', $users_ids);
if(!$result = $mysqli->query("SELECT * FROM user WHERE id IN ({$users_ids})"))
  die($mysqli->error.PHP_EOL);
$rows = $result->fetch_all(MYSQLI_ASSOC);
$result->close();
foreach($rows as $row)
{
  $result = new stdClass();
  $result->id = $row['id'];
  $result->name = $row['name'];
  $result->sex = $row['sex'];
  $result->image_36 = "http://onedayofmine.dev/users/default_image_36.png";
  $result->image_72 = "http://onedayofmine.dev/users/default_image_72.png";
  $result->image_96 = "http://onedayofmine.dev/users/default_image_96.png";
  $result->image_192 = "http://onedayofmine.dev/users/default_image_192.png";
  $result->birthday = $row['birthday'];
  $result->occupation = $row['occupation'];
  $result->location = $row['location'];

  foreach($days as $day)
  {
    if($day->user_id == $row['id'])
      $day->user = $result;
  }
}

echo json_encode([
  'code' => 200,
  'status' => 'OK',
  'result' => array_values($days),
  'errors' => []
]);

