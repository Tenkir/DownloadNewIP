<?php 
require_once "php/common.php";

//** IP ADDRESS SHENANIGANS BEGIN **// 
/***********************************/

$ip_addr = getUserIP();
//$ip_addr = long2ip(rand(0, "4294967295"));

$geoplugin = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip_addr) );

if ( is_numeric($geoplugin['geoplugin_latitude']) && is_numeric($geoplugin['geoplugin_longitude']) ) 
{
	$lat = $geoplugin['geoplugin_latitude'];
	$long = $geoplugin['geoplugin_longitude'];
	
	$region = $geoplugin['geoplugin_region'];
	$city = $geoplugin['geoplugin_city'];
	$country = $geoplugin['geoplugin_countryName'];
}

//** TWITTER SHENANIGANS BEGIN **// 
/********************************/

$returnString = json_decode(getTwitterFeed('%23Corgi', 5), $assoc = TRUE);
							
$bubbleString = "";							
if($returnString['errors'][0]['message'] == '')
{

	foreach($returnString['statuses'] as $items)
	{
		$tweet = $items['text'];
		$time = $items['created_at'];
		$user = $items['user']['name'];
		$screenName = $items['user']['screen_name'];
		
		$bubbleString = $bubbleString . "\t\t\t\t<div class='bubble'><div class='bubble_author'>$user</div><br/>$tweet</div>\n";
	}
}
else if($returnString['errors'][0]['message'] != '')
{
	$bubbleString = "There was a problem. Twitter returned the following error message:<br/><br/>" . $string['errors'][0]['message'];
}

/********************************/

$captionArray = array(
	'Totally not a scam!',
	'Satisfaction guaranteed!',
	'100% not a virus!',
	'Fun for the whole family!'
);

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Download A New IP!</title>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<link rel="shortcut icon" type="image/x-icon" href="img/icon.png" />
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<script type="text/javascript">
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-61804375-1', 'www.downloadnewip.com');
	  ga('send', 'pageview');
	</script>
</head>
<body>
	<div class="jumbotron header whiteText">
		<img class="headerIcn" src="img/icon.png"/>
		<h1>Download New IP</h1>
		<h2>Fast, Free, and Secure!</h2>
	</div>

	<div class="container">
		<div class="col-sm-8">
		
			<h1>How Download New IP Works</h1>
			<a name="top">Download New IP</a> provides state of the art privacy protection using advanced IP protocol. 
			<br><br>
			Our service has been designed from the ground up to be compatible with pre-existing built-in technology on either your computer or smartphone. Our service operates on the IP interface level, which means all of your applications will be secured.
			<br><br>
			<div class="well header">
				<h2>Instant activation with no installation required!</h2>
			</div>

			<button class="btn btn-block btn-lg btn-info">
				<i class="fa fa-cloud-download"></i> Download New IP!
			</button>
		
			
			<div class="block" id="ip-cloak_block">
				<div class="title_box">
					<a name="ip-cloak">IP Cloaking</a>
				</div>
				
				<div class="map_holder">
					<div class="map_hold">
						<img src="https://maps.google.com/maps/api/staticmap?center=<? echo $lat; ?>,<? echo $long; ?>&zoom=12&sensor=false&size=190x155" title="Map of Your Location" alt="Map of Your Location">
					</div>
					<div class="map_data">
						<h3>Your Public Information</h3>
						<ul>
							<li><label>IP Address:</label><? echo $ip_addr; ?></li>
							<li><label>City:</label><? echo $city; ?></li>
							<li><label>Region:</label><? echo $region; ?></li>
							<li><label>Country:</label><? echo $country; ?></li>
						</ul>
					</div>
				</div>
				<div class="subtitle">Hide your IP to block unwanted privacy leaks</div>
				Our <b>IP cloak</b> masks your real IP address with one of our <b>anonymous IP</b> addresses, keeping websites and internet services from tracking your habits, monitoring your searches, and discovering your location. 
				<br><br>
				After establishing a secure connection to our server, you will be issued a new IP address which will place you at a different location.
				<div class="download_btn">Download New IP!</div>
			</div>
			
			<div class="block" id="id-prot_block">
				<div class="title_box">
					<a name="id-prot">Identity Protection</a>
				</div>
				
				<div class="block_img"><img src="img/identity.png" alt="Identity Protection" title="Identity Protection"></div>
				<div class="subtitle">Browse anonymously</div>
				If your identity puts you at risk, anonymously browsing and posting anonymously online are of critical importance. <b>Avoid being exposed.</b>
				<br><br>
				Additionally, anonymous browsing prevents data mining, keeping your data and identity secret. Privacy is very important in this era, websites are able to create a clear image of who you are and learn which websites you visit regularly with publicly available information.
				<div class="download_btn">Download New IP!</div>
			</div>

			<div class="block" id="unfiltered_block">
				<div class="title_box">
					<a name="unfiltered">Unfiltered Access</a>
				</div>
				
				<div class="block_img"><img src="img/unfiltered.png" alt="Unfiltered Access" title="Unfiltered Access"></div>
				<div class="subtitle">Unfiltered access to any country-based internet service</div>
				Your new IP address provides unfiltered access to the complete internet. Our service will bypass any strict censorships, effectively providing you unrestricted access. In addition our IP addresses provide the strongest levels of privacy available. 
				<br><br>
				Additionally, your new IP address will unblock any previously <b>blocked software</b> including P2P, VOIP, and other various applications. While providing complete access to your favorite websites and video streams, including Twitch, Youtube, and MySpace.
				<div class="download_btn">Download New IP!</div>
			</div>
		
		</div>
		<div class="col-sm-4">
			<h3>Services Offered</h3>
			<ul>
				<li><a href="#ip-cloak"><i class="fa fa-check"></i> IP Cloaking</a></li>
				<li><a href="#id-prot"><i class="fa fa-check"></i> Identity Protection</a></li>
				<li><a href="#unfiltered"><i class="fa fa-check"></i> Unfiltered Access</a></li>
			</ul>
			
			<h3>User Testimonies</h3>
			<div class="bubble_wrapper">
				<? echo $bubbleString; ?>
			<a id="twitter_button" href="https://twitter.com/intent/tweet?button_hashtag=DownloadNewIP" class="twitter-hashtag-button" data-size="large">Tweet #DownloadNewIP</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			</div>
			
			<div class="ad_loc">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<ins class="adsbygoogle"
					 style="display:inline-block;width:300px;height:600px"
					 data-ad-client="ca-pub-5175658031507701"
					 data-ad-slot="5019762567"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
		</div>
	</div>
	<div class="footer">
		<a href="#">Contact Us</a> | <a href="#">Terms of Use</a> | <a href="#">Trademarks</a> | <a href="#">Privacy Statement</a><br />
		This product includes GeoLite data created by <a href="http://www.maxmind.com">MaxMind</a>.<br />
		Copyright 2015 -- All Rights Reserved. 
		<br /><br />
		This isn't a scam, nor a virus, it's a joke.
		
		<!--Created by: http://mattstruble.com -->
	</div>
</body>
</html>