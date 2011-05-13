<?php
include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
// $consumer_key = '5CapZSgvdGCd1y8D9opMhg';
// $consumer_secret = 'j5y452t3XUCE29NwpLbTIDu1V5KFWjKs5yPQHBE';
// $twitterObjUnAuth = new EpiTwitter($consumer_key, $consumer_secret
$twitterObj = new EpiTwitter();
$hash = $twitterObj->get_basic('http://search.twitter.com/search.json?callback=result&q=hackny');
print_r($hash);
?>