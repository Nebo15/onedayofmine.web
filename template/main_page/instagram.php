<?php
$token = '253996930.1fb234f.876dc9200d324a5088beffa77059d189';

echo "<form action='' method='GET'><input type='text' name='query'><input type='submit'></form>";

if(isset($_GET['user']))
{
	echo 'Requests:<br/><pre>';
	$photos = get_photos_recursively('https://api.instagram.com/v1/users/'.$_GET['user'].'/media/recent/?access_token='.$token);
	echo '</pre>';

	echo 'All photos count - '.count($photos).'<br/><br/>';

	$days = [[array_shift($photos)]];
	foreach($photos as $photo)
	{
		$current_day = $days[count($days)-1];
		$prev_photo = $current_day[count($current_day)-1];
		if(($photo->time - $prev_photo->time) < 4 * 60 * 60)
		{
			$days[count($days)-1][] = $photo;
		}
		else
		{
			$days[] = [$photo];
		}
	}

	foreach($days as $key => $day)
	{
		if(count($day) < 3)
			continue;

		echo 'Photos in day '.$key.' ('.count($day).'): <ul>';

		foreach($day as $photo)
		{
			echo '<li style="float:left;width:200px;height:250px;overflow: hidden">';
			echo "<a href='{$photo->link}'><img src='{$photo->thumb}'/></a>";
			echo "<br/><b>Time: </b>".date('Y.m.d H:i:s', $photo->time);
			echo "<br/><b>Caption: </b>{$photo->caption}";
			echo '</li>';
		}
		echo '</ul>';
		echo '<br style="clear:both">';
	}


}
elseif(isset($_GET['query']))
{
	$request = request('https://api.instagram.com/v1/users/search?q='.$_GET['query'].'&access_token='.$token);
	echo '<ul>';
	foreach($request->data as $user)
	{
		echo '<li><a href="?user='.$user->id.'">'.$user->username.'</a></li>';
	}
	echo '</ul>';
}

function get_photos_recursively($url)
{
	echo $url.'<br/>';
	$request = request($url);

	if(!isset($request->data))
		var_dump($request);

	$photos = [];
	foreach($request->data as $raw_photo)
	{
		$photo = new stdClass();
		$photo->time = $raw_photo->created_time;
		$photo->caption = is_object($raw_photo->caption) && property_exists($raw_photo->caption, 'text') ? $raw_photo->caption->text : null;
		$photo->link = $raw_photo->link;
		$photo->thumb = $raw_photo->images->thumbnail->url;
		$photos[$photo->time] = $photo;
	}
	if($request->pagination && property_exists($request->pagination, 'next_url'))
		$photos = $photos + get_photos_recursively($request->pagination->next_url);
	ksort($photos);
	return $photos;
}

function request($url)
{
	$hash = md5($url);
	$cache_file = __DIR__.'/var/'.$hash;
	if(!file_exists($cache_file))
	{
		$request = new HttpRequest();
		$request->setUrl($url);
		$response = $request->send();
		file_put_contents($cache_file, serialize($response));
	}
	$content = isset($response) ? $response : unserialize(file_get_contents($cache_file));
	$body = json_decode($content->getBody());
	return $body;
}


?>