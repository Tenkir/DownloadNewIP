<?php 
require_once('TwitterAPIExchange.php');

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function getTwitterFeed($search, $count)
{
	// Remove anything that isn't a word, whitespace, or number
	// or any of the following characters -_~;:[]().
	$fileName = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).])", '', $search);
	// Remove any runs of periods
	$fileName = preg_replace("([\.]{2,})", '', $fileName);
	
	$local_file = 'xxxxxxxxxxxxxxxxx'.$fileName.'.json';
	
	
	$settings = array(
		'oauth_access_token' => "xxxxxxxxxxxxxxxxxxx",
		'oauth_access_token_secret' => "xxxxxxxxxxxxxxxxxx",
		'consumer_key' => "xxxxxxxxxxxxxxxxx",
		'consumer_secret' => "xxxxxxxxxxxxxxxxxxxxxxxxxx"
	);

	$twitter = new TwitterAPIExchange($settings);
	$url = "https://api.twitter.com/1.1/search/tweets.json";
	$requestMethod = "GET";
	$getfield = "?q=$search&count=$count";
	
	$results = '';
	
	if(is_file($local_file))
	{
		$time_lapse = (strtotime("now") - filemtime($local_file));
		
		if($time_lapse > 8)
		{	
			$results = $twitter->setGetField($getfield)
						->buildOauth($url, $requestMethod)
						->performRequest();
						
			$stringCheck = json_decode($results, $assoc = TRUE);
			
			if($returnString['errors'][0]['message'] == '')
			{
				file_put_contents($local_file, $results);
			}
		}
		else
		{
			$results = file_get_contents($local_file);
		}
	}
	else
	{
		$results = $twitter->setGetField($getfield)
					->buildOauth($url, $requestMethod)
					->performRequest();
						
		$stringCheck = json_decode($results, $assoc = TRUE);
		
		if($returnString['errors'][0]['message'] == '')
		{
			file_put_contents($local_file, $results);
		}
	}
	
	return $results;
}

?>