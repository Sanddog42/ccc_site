<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://www.castrocountryclub.com
 * @since      1.0.0
 *
 * @package    Facebookevents
 * @subpackage Facebookevents/public/partials
 */

//echo ('public display: ' . print_r($this->events, true));

	error_log(print_r($this->events, true));

	

if(isset($this->events['error'])){
	error_log("inside the conditional: " . $this->events['error'] );
	echo '<h3 style="font-weight: bold;">' . $this->events['error'] .'</h3>';
	return;
}
if(!isset($size)){
	$size = count($this->events);
}
if(!isset($contentList)){
	$contentList = array('image', 'address', 'full', 'header');
	error_log('setting content list inside facebvook events p8ublic');
}
$counter = 0;

error_log("size is $size content list is " . print_r($contentList, true) );

foreach ($this->events as $event) {
	if($counter == $size)
		return;
	else
		$counter++;

	//echo ('more testing ');
	$startDateTime = date_create($event['start_time']);
	$endDateTime = date_create($event['end_time']);
	$cover = "";
	
	if(array_key_exists('cover', $event))
		$cover = $event['cover'];

	$name = "";
	if(array_key_exists('name', $event))
		$name = $event['name'];


	$place = "";
		if(array_key_exists('address', $event))
		$place = $event['address'];

	$description = "";
	if(array_key_exists('description', $event))
		$description = $event['description'];


	// create html anchors out of any string urls
	$url = '@(http)?(s)?(://)(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
	$description = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $description);

	// then convert any new lines to <br/>

	$description = nl2br($description, true);

	// format place
	$placeName = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $place['name']);

	$hasAddress = isset($place['location']);
	if($hasAddress){
		$city = $place['location']['city'];
		$state = $place['location']['state'];
		$street = $place['location']['street'];
		$zip = $place['location']['zip'];
		$address = '<div>' . $street . '<br/>' . $city . ', ' . $state . ', ' . $zip . '</div>';
	}

	
	if(in_array('header', $contentList)){ 
		$time = date_format($startDateTime, 'l F d, Y g:i a') .' to ' . date_format($endDateTime, ' g:i a');
		echo ("<h3 style='font-weight: bold;'> $name </h3>");
		echo ("<h4> $time </h4>");
	}
	if(in_array('image', $contentList)){ 
		$source = $cover['source'];
		echo ("<div style='text-align: center;'><img src='$source'></div>");
	}
	if(in_array('address', $contentList)){
		echo ("<div>$placeName</div>");
		echo ("<div>$address</div>");
	}
	if(in_array('full', $contentList))
	{
		echo ("<div>$description</div> <br/>");
	}
}

?>