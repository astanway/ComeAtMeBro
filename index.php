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
  font-family: helvetica;
}


.field{
	font-family: helvetica;
    height: 45px; width: 90%;
    font-size: 33px;
    border: 3px #b0bac9 solid;
    border-radius: 5px;
    color: #7385a0;
	margin: 5px;
	text-align: center;
}

#form{
	font-family: helvetica;
	text-align: center;
    font-family: helvetica;
/*	margin-left: auto;
	margin-right: auto;*/
	position: relative;
/*	bottom:19em;
	left:22em;
*/
	width: 470px;
	padding-top: 3em;
	float: right;
}

#content{
	font-family: helvetica;
	text-align: center;
	font-size: 30px;
}

#first{
	margin: 0 auto;
	text-align: center;
	width:1019px;
	padding-top: 50px;
	position: relative;
	z-index: 20;
}

#main{
	font-family: helvetica;
	font-size: 19px;
	text-align: center;
}

#fighting{
	font-family: helvetica;
	color: #949696;
/*	color: #A8B4AF;*/
	text-shadow:#DDECD9 0 1px;
	font-size: 25px;
	font-weight: bold;
	text-align:center;
	padding-top: 20em;
	width: 500px;
	margin-right: auto;
	margin-left: auto;
	position: relative;
}

h4, h1{
	padding: 0;
	margin: 0;
	font-family: helvetica;
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

#insults{
	font-size:19px;
	font-family: helvetica;
	padding-top: 65px;
	float:left;
	text-align: left;
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
</style>
<html>
<body>
	<!-- <img src="pinkback.jpg" alt="background image" id="bg" /> -->
	<div id="first">
		<img src="ComeAtMeBroold.png" style="vertical-align:middle; float: left;"></img>
		<form id='form' method="GET" action='fight.php'>
			 <table> 
		            <tr> 
		              <th style="text-align:center;"><label for="number">Twitter: <br></label></th> 
		              <td> 
		                <input type="text" class="field" tabindex="1" name="twitter" size="20"> 
		              </td> 
		            </tr> 
		             <tr> 
		               <th style="text-align:center;"><label for="p_subj_cd">Hash: <br></label></th> 
		               <td> 
		                 <input type="text" class="field"  id="p_subj_cd" tabindex="1" name="hash" size="5"> 
		               </td> 
		             </tr> 
		             <tr>
					</table>
					<br>
		<b>	Make it a gang fight?</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type ='radio' name='gang' value='True'>Sure!</input>
			<input type ='radio' name='gang' value='False'>Not in the mood</input><br>
			<br>
			<br>
			<input type ='submit' id="title" value="COME @ ME BRO!"></input>
		</form>
	</div>
<br>

<div id = 'main'>
<?php

if(isset($_GET['twitter']) && isset($_GET['hash']) && isset($_GET['gang'])){
	
	$gang = $_GET['gang'];
	$user_twitter = $_GET['twitter'];
	$hash = "#".$_GET['hash'];
	$hash = str_replace('#','',$hash);
	$user_twitter = str_replace('@', '', $user_twitter);

	
	include 'EpiCurl.php';
	include 'EpiOAuth.php';
	include 'EpiTwitter.php';
	$twitterObj = new EpiTwitter();
	$date = date("Y-m-d");

	//if you have time, figure out how to get them all
	$resp = $twitterObj->get('/search.json', array('q' => $hash, 'since' => $date, 'rpp' => '100'));  
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
			
			echo "Go fight <b>" . $user_id."</b> for his inferior taste in movies.";
		} else {
			$douche = min($offenses);
			$douche_key = array_search($douche, $offenses);
			$douche_name = $user_array[$douche_key];
			//get twitter stuff
						// $url = 'http://api.twitter.com/1/users/show.json?screen_name='.$douche_name;
						// $user_name = json_decode(file_get_contents($url));
						// $douche_name = $user_name->name;
			echo "<b> " . $douche_name;
			unset($offenses[$douche_key]);
			$offenses = array_values($offenses);
			unset($user_array[$douche_key]);
			$user_array = array_values($user_array);
					
			$douche = min($offenses);
			$douche_key = array_search($douche, $offenses);
			$douche_name = $user_array[$douche_key];
			//get twitter stuff
			// $url = 'http://api.twitter.com/1/users/show.json?screen_name='.$douche_name;
			// $user_name = json_decode(file_get_contents($url));
			// $douche_name = $user_name->name;
			echo "</b> and <b>" . $douche_name;
			unset($offenses[$douche_key]);
			$offenses = array_values($offenses);
			unset($user_array[$douche_key]);
			$user_array = array_values($user_array);	
			echo " </b>will get yo' back while you fight<br> ";
			
			$douche = max($offenses);
			$douche_key = array_search($douche, $offenses);
			$douche_name = $user_array[$douche_key];
			//get twitter stuff
						// $url = 'http://api.twitter.com/1/users/show.json?screen_name='.$douche_name;
						// $user_name = json_decode(file_get_contents($url));
						// $douche_name = $user_name->name;
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
			
			echo " </b>and<b> " . $douche_name."</b> for their inferior tastes in movies.";
			unset($offenses[$douche_key]);
			$offenses = array_values($offenses);
			unset($user_array[$douche_key]);
			$user_array = array_values($user_array);
			
			
			//Twitter->Face->PhPCrop->Flash->Win.		
			//echo "<img src='http://api.twitter.com/1/users/profile_image/twitter.json?size=bigger&screen_name=".$douche_name."'></img>";
					
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
<div id="insults">

<?php
if(isset($_GET['twitter']) && isset($_GET['hash']) && isset($_GET['gang'])){
	echo "<h4>Suggested insults:</h4>";
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
		$dude = str_replace('POOP', '<b>'.$stinkynames[$insult].'</b>', $insults[$insult]);
		echo $dude;
		echo "<br>";
	}
}

?>
</div>
<br>
<br>
<div id ="fighting">
	<?php
		$quotes = array(
			'&#8220;I am not above slapping a bitch.&#8221; <div id="oscar"> - Oscar Wilde</div>',
			'&#8220;Do not tempt me. I will eat your dreams.&#8221; <div id="oscar"> - Thoreau</div>',
			'&#8220;I always carry a pair of brass knuckles for miscreants like yourself.&#8221; <div id="oscar"> - Oscar Wilde</div>',
			);

		$rand = array_rand($quotes, 1);
		echo $quotes[$rand];
	?>
				<div class ="sub">powered by <a href="http://www.hunch.com">hunch</a></div>
	</div>
	</div>
</body>
</html>