<?php

namespace Controllers;
use Models\Address as Address;
use DAO\UserDAO as UserDAO;
use Models\User as User;
use Util\Validate as Validate;
use Controllers\HomeController as HomeController;


class ProfileController 
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function View($alertMessage = "", $alertType = ""){
        require_once(VIEWS_PATH . "ProfileView.php");
    }

    public function Index(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = new User();
            $user->setEmail($_SESSION['User']['Email']);
            $user->setUserName(Validate :: ValidateData($_POST["UserName"]));
            $user->setBirthDate(Validate :: ValidateData($_POST["BirthDate"]));
            $user->setGender(Validate :: ValidateData($_POST["gender"]));
            $user->setPhoto($_SESSION['User']['Photo']);              

            try {
                $result = $this->userDAO->UpdateUser($user);
                $_SESSION['User'] = $result[0];
                $alertMessage = "Se a actualizado satisfactoriamente su perfil!" ;
                $alertType = "success";
                $this->View($alertMessage, $alertType);
            } catch (Exception $e) {
                $this->View();
            }
        } else {
            $this->View();
        }
    }

    public function ChangeImageProfile(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newImage = $_POST["photo"];
            $user = new User();
            $user->setEmail($_SESSION['User']['Email']);
            $user->setUserName(Validate :: ValidateData($_SESSION['User']['UserName']));
            $user->setBirthDate(Validate :: ValidateData($_SESSION['User']['Birthdate']));
            $user->setGender(Validate :: ValidateData( $_SESSION['User']['IdGender']));
            $user->setPhoto(Validate :: ValidateData($newImage));
            try {
                $result = $this->userDAO->UpdateUser($user);
                $_SESSION['User'] = $result[0];
                $alertMessage = "Se a actualizado su imagen de perfil!" ;
                $this->View($alertMessage);
            } catch (Exception $e) {
                $this->View();
            }
        } else {
            $this->View();
        }
    }


}
?>