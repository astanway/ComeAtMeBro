<link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>


<style type="text/css">

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}


html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}


body{
	font-family: helvetica;
/*	background-image:url('pinkback.jpg');
	background-repeat: no-repeat;
	background-position:-223px -126px;
	background-attachment:fixed;
	background-width: 100%;*/
}

#content{
	font-family: helvetica;
	text-align: center;
	font-size: 30px;
	z-index: 2;
	position: relative;
}

#main{
	font-family: helvetica;
	font-size: 19px;
	text-align: center;
	z-index: 1;
	position: relative;
}

#fighting{
	font-family: helvetica;
	color: #949696;
	font-size: 25px;
	font-weight: bold;
	text-align:center;
	position: relative;
	top: 26em;
	display: block;
	width:500px;
	margin: 0 auto;
	text-shadow:#DDECD9 0 1px;
}

h4, h1{
	padding: 130px 0px 10px 104px;
	margin: 0;
	font-weight: bold;
	font-family: helvetica;
	font-size: 4em;
	color: #C9CDCF;
}

#title{
	background-color: #FFF;
	font-size:64px;
	padding: 10px;
	font-weight: bold;
	margin: 0;
	font-family: Bangers;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}

#oscar{
	display: block;
	text-align: center;
	font-family: helvetica;
}

.insults{
	font-size: 1.8em;
	font-family: helvetica;
	padding-top: 0.9px;
	text-align: center;
	position: relative;
	z-index: 3;
	width: 850px;
	height: 65px;
	margin-left: auto;
	margin-right: auto;
	clear: both;
	padding-left: 233px;
}

.sub, a, a:visited{
	text-decoration: none;
	font-family: helvetica;
	font-size: 13px;
	color: #c7ccd7;
	text-align: center;
	margin-top: 18px;
	font-weight: 100;
}
a:hover{
	font-family: helvetica;
	color:#A6B5B6;
	font-weight: 300;
}

body{
	overflow: hidden;
}

#bg {
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
}


.insults div{
	width: 259px;
	height: 200px;
	float: left;
	display: block;
	margin: 0 12px;
	z-index: 4;
}

#friends{
	width: 24em;
	float: left;
	height: 2.1em;
	padding:5px;
	margin-bottom:5px;
	padding-right:8px;
	text-align: right;
	background-color:#FF6EF2;
}

#enemies{
	float: right;
	width: 34em;
	padding:5px;
	padding-left:8px;
	height: 2.1em;
	text-align: left;
	background-color:black;
	color: white;
}

#single{
	float: right;
	width: 37em;
	padding:.4em;
	padding-left:8px;
	height: 1em;
	text-align: left;
	background-color:black;
	color: white;
}

</style>
<html>
	<body>
	<!-- <img src="pinkback.jpg" alt="background image" id="bg" /> -->
	<div id="main_container">
		<div id="fighting">
		<?php
		$quotes = array(
			'&#8220;I am not above slapping a bitch.&#8221; <div id="oscar"> - Oscar Wilde</div>',
			'&#8220;Do not tempt me. I will eat your dreams.&#8221; <div id="oscar"> - Thoreau</div>',
			'&#8220;I always carry a pair of brass knuckles for miscreants like yourself.&#8221; <div id="oscar"> - Oscar Wilde</div>',
			);
			$rand = array_rand($quotes, 1);
			echo $quotes[$rand];
		?>

		</div>
<div id = 'main'>
<?php

if(isset($_GET['twitter']) && isset($_GET['hash'])){

	$gang = False;
	if(isset($_GET['gang'])){
		$gang = $_GET['gang'];
	}
	
	$user_twitter = $_GET['twitter'];
	$hash = $_GET['hash'];
	$hash = str_replace('#','',$hash);
	$user_twitter = str_replace('@', '', $user_twitter);

	
	include 'EpiCurl.php';
	include 'EpiOAuth.php';
	include 'EpiTwitter.php';
	$twitterObj = new EpiTwitter();
	$date = date("Y-m-d");

	//if you have time, figure out how to get them all
	$resp = json_decode(file_get_contents("http://search.twitter.com/search.json?q=%23".$hash));  
	$results = $resp->results;
	$user_array = array();
	$offenses = array();
	$user_names = array();
	foreach($results as $user){
		$user_id = $user->from_user;
		
		//check for duplicates
		if($user_id == $user_twitter){
			continue;
		}
		
		if(!in_array($user_id, $user_array)){
			array_push($user_array, $user_id);
			array_push($offenses, 0);
		}
	}



	//populates your likes
	$initial = json_decode(file_get_contents('http://api.hunch.com/api/v1/get-recommendations/?user_id=tw_'. $user_twitter .'&topic_ids=list_movie&popularity=.1&limit=10&minimal=true'));
	$recArray = $initial->recommendations;
	$likes = array();
		foreach ($recArray as $hn){
			$hn_id = $hn->result_id;
			array_push($likes, $hn_id);
		}
	
	//populates your dislikes	
	$stinky = array();
	$stinkynames = array();
		foreach($likes as $hn){
		$dislike = json_decode(file_get_contents('http://api.hunch.com/api/v1/get-recommendations/?dislikes='. $hn .'&topic_ids=list_movie&popularity=.1&limit=5&minimal=true'));
		$disRecs = $dislike->recommendations;
			foreach($disRecs as $dis){
				$hn_id = $dis->result_id;
				array_push($stinkynames, $dis->name);
				array_push($stinky, $hn_id);
			}
		}
	
		//populates everyone's likes, one at a time. if they like anything in your dislikes, they get an offense++
		foreach($user_array as $key => $contender){
			$offense = 0;
			$initial = json_decode(file_get_contents('http://api.hunch.com/api/v1/get-recommendations/?user_id=tw_'. $contender .'&topic_ids=list_movie&popularity=.1&limit=15&minimal=true'));
			$recArray = $initial->recommendations;
				foreach ($recArray as $hn){
					$hn_id = $hn->result_id;
					if(in_array($hn_id, $stinky)){
						$offense++;
					}
				}
				$offenses[$key] = $offense;
			}
	
echo "<div id='content'>";
		if($gang == "False"){
			$douche = max($offenses);
			$douche_key = array_search($douche, $offenses);
			$user_id = $user_array[$douche_key];
			//get twitter stuff

			// $url = 'http://api.twitter.com/1/users/show.json?screen_name='.$user_id;
			// $user_name = json_decode(file_get_contents($url));
			// $user_id = $user_name->name;
			// $url = 'http://api.twitter.com/1/users/profile_image/twitter.json?size=bigger&screen_name='.$user_id.'&size=bigger';
			// $ch = curl_init($url);
			// $fp = fopen('flower.jpg', 'wb');
			// curl_setopt($ch, CURLOPT_FILE, $fp);
			// 		  	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
			// curl_setopt($ch, CURLOPT_HEADER, 0);
			// curl_exec($ch);
			// curl_close($ch);
			// fclose($fp);
			
			echo "<div id='single'>Go fight <b>" . $user_id."</b> for his inferior taste in movies.</div>";
		} else {
			echo "<div id='friends'>";
			$douche = min($offenses);
			$douche_key = array_search($douche, $offenses);
			$douche_name = $user_array[$douche_key];

			echo "<b> " . $douche_name;
			unset($offenses[$douche_key]);
			$offenses = array_values($offenses);
			unset($user_array[$douche_key]);
			$user_array = array_values($user_array);
					
			$douche = min($offenses);
			$douche_key = array_search($douche, $offenses);
			$douche_name = $user_array[$douche_key];

			echo "</b> and <b>" . $douche_name;
			unset($offenses[$douche_key]);
			$offenses = array_values($offenses);
			unset($user_array[$douche_key]);
			$user_array = array_values($user_array);	
			echo " </b><br>will get yo' back while you fight</div><br><br><div id='enemies'> ";
			
			$douche = max($offenses);
			$douche_key = array_search($douche, $offenses);
			$douche_name = $user_array[$douche_key];

			echo "<b>";
			echo $douche_name;
			unset($offenses[$douche_key]);
			$offenses = array_values($offenses);
			unset($user_array[$douche_key]);
			$user_array = array_values($user_array);
		
			$douche = max($offenses);
			$douche_key = array_search($douche, $offenses);
			$douche_name = $user_array[$douche_key];
			//get twitter stuff
			// $url = 'http://api.twitter.com/1/users/show.json?screen_name='.$douche_name;
			// $user_name = json_decode(file_get_contents($url));
			// $douche_name = $user_name->name;
			
			echo " </b>and<b> " . $douche_name;
			unset($offenses[$douche_key]);
			$offenses = array_values($offenses);
			unset($user_array[$douche_key]);
			$user_array = array_values($user_array);
			
			
			$douche = max($offenses);
			$douche_key = array_search($douche, $offenses);
			$douche_name = $user_array[$douche_key];
			//get twitter stuff
			// $url = 'http://api.twitter.com/1/users/show.json?screen_name='.$douche_name;
			// $user_name = json_decode(file_get_contents($url));
			// $douche_name = $user_name->name;
			
			echo " </b>and<b> " . $douche_name."</b><br> for their inferior tastes in movies.</div>";
			unset($offenses[$douche_key]);
			$offenses = array_values($offenses);
			unset($user_array[$douche_key]);
			$user_array = array_values($user_array);
			// echo "<img src='http://api.twitter.com/1/users/profile_image/twitter.json?size=bigger&screen_name=".$douche_name."'></img>";
					
		}
	} else{
		// die();
	}
?>
</div>
<br>
<br>
</div>
<div id="container">
	<h4>Suggested Insults:</h4>
<div class="insults">

<?php
if(isset($_GET['twitter']) && isset($_GET['hash'])){
	$insults = array(
		"You are the biggest waste of life because you like POOP",
		"Wow, that punch was as bad as the ending to POOP",
		"I would rather eat my own face than watch POOP",
		"Your fighting is as bad as that black guy from POOP's acting",
		"You're going down, just like that idiot from POOP",
		"I am going to beat you over the head with a copy of POOP",
		);
	
	$movie = array_rand($stinkynames, 3);
	
	$rand = array_rand($insults, 3);
	
	foreach ($rand as $insult){
		$i = 0;
		$dude = str_replace('POOP', '<b>'.$stinkynames[$insult].'</b>', $insults[$insult]);
		echo "<div class='insult.$i.'>".$dude."</div>";
		$i++;
	}
}

?>
</div>
<br>
<br>
		</div>
	</div>
	</body>
</html>