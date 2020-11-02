<?php

namespace Controllers;

use Controllers\LoginController as LoginController;
use Facebook\Exceptions\FacebookResponseException as FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException as FacebookSDKException;
use Models\User as User;
use Facebook\Facebook as Facebook;

class FacebookController
{
    private $loginController;
    
    public function __construct()
    {
        $this->loginController = new LoginController();
    }

    public function logIn($me)
    {
        $fb = new Facebook([
            'app_id' => FACEBOOK_APP_ID,
            'app_secret' => FACEBOOK_APP_SECRET,
            'default_graph_version' => 'v2.5',
        ]);
        
        $helper = $fb->getRedirectLoginHelper();
        
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
        
        try {
            // Get the Facebook\GraphNodes\GraphUser object for the current user.
            $response = $fb->get('/me?fields=picture,id,name,email,first_name,last_name', $accessToken->getValue());
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'ERROR: Graph ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'ERROR: validation fails ' . $e->getMessage();
            exit;
        }
        
        $user = $response->getGraphUser();

        $array = array("Email" => $user["email"],
                                       "IdUser" => null,
                                       "UserName" => $user["name"],
                                       "UserPassword" => null,
                                       "IdGender" => null,
                                       "Photo" => null,
                                       "Birthdate" => null,
                                       "IsAdmin" => false,
                                       "ChangedPassword" => null);
        $this->loginController->facebookIndex($array);
    }
}