<?php
use Facebook\Exceptions\FacebookResponseException as FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException as FacebookSDKException;

# Set the default parameters
$fb = new Facebook\Facebook([
   'app_id' => '2502503073311723',
   'app_secret' => 'f51af491f452edd614281042a3f2c296',
   'default_graph_version' => 'v2.5',
]);
$redirect = 'http://localhost/MoviePass/';


# Create the login helper object
$helper = $fb->getRedirectLoginHelper();

# Get the access token and catch the exceptions if any
try {
   $accessToken = $helper->getAccessToken();
} catch (FacebookResponseException $e) {
   // When Graph returns an error
   echo 'Graph returned an error: ' . $e->getMessage();
   exit;
} catch (FacebookSDKException $e) {
   // When validation fails or other local issues
   echo 'Facebook SDK returned an error: ' . $e->getMessage();
   exit;
}

# If the 
if (isset($accessToken)) {
   // Logged in!
   // Now you can redirect to another page and use the
   // access token from $_SESSION['facebook_access_token'] 
   // But we shall we the same page

   // Sets the default fallback access token so 
   // we don't have to pass it to each request
   $fb->setDefaultAccessToken($accessToken);

   try {
      $response = $fb->get('/me?fields=email,name');
      $userNode = $response->getGraphUser();
   } catch (FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
   } catch (FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
   }


   // Print the user Details
   echo "Welcome !<br><br>";
   echo 'Name: ' . $userNode->getName() . '<br>';
   echo 'User ID: ' . $userNode->getId() . '<br>';
   echo 'Email: ' . $userNode->getProperty('email') . '<br><br>';

   $image = 'https://graph.facebook.com/' . $userNode->getId() . '/picture?width=200';
   echo "Picture<br>";
   echo "<img src='$image' /><br><br>";
} else {
   $permissions  = ['email'];
   $loginUrl = $helper->getLoginUrl($redirect, $permissions);
   echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}
