<?php

$fb = new Facebook\Facebook([
   'app_id' => FACEBOOK_APP_ID,
   'app_secret' => FACEBOOK_APP_SECRET,
   'default_graph_version' => 'v2.5',
]); 
 
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions for more permission you need to send your application for review
$loginUrl = $helper->getLoginUrl('http://localhost/MoviePass/Facebook/Custom/fblogin-callback.php', $permissions);
header("location: ".$loginUrl);
?>