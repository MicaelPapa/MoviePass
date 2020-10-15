<?php

namespace Controllers;


use DAO\UserDAO as UserDAO;
use Exception;
use Models\User as User;
use Util\Validate as Validate;
use Util\Hash as Hash;
use Controllers\HomeController as HomeController;

class RegisterController 
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function Index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = Validate :: ValidateData($_POST["email"]);
            $user = Validate :: ValidateData($_POST["userName"]);
            $password = Validate :: ValidateData($_POST["password"]);
            $passwordConfirmed = Validate :: ValidateData($_POST["passwordConfirmed"]);
            $birthdate = Validate :: ValidateData($_POST["birthdate"]);
            $gender = Validate :: ValidateData($_POST["gender"]);

            if($gender == 1){
                $photo = FRONT_ROOT.VIEWS_PATH."img/girl-1.png";
            } else if($gender == 2){
                $photo = FRONT_ROOT.VIEWS_PATH."img/man-2.png";
            } else {
                $photo = FRONT_ROOT.VIEWS_PATH."img/other.png";
            }

            $this->ValidateRegister($email, $user, $password, $passwordConfirmed, $birthdate);

            try {
                $password = Hash::Hashing($password); //hashing password
                $selectedUser = $this->userDAO->Add(new User($email, $user, $password, $birthdate, $gender, $photo));

                if ($selectedUser != null) {
                    $_SESSION['User'] = $selectedUser[0];
                    $_SESSION['isLogged'] = true;                    
                }                

                HomeController :: Index();
                
            } catch (Exception $e) {
                $this->View();
            }
        } else {
            $this->View();
        }
    }

    private function ValidateRegister($email, $userName, $password, $passwordConfirmed, $birthdate)
    {
        if ($password !== $passwordConfirmed)
            $this->View("Las contraseñas no coinciden");

        if ($this->userDAO->SearchUserByEmail($email) != null)
            $this->View("Ese E-mail pertenece a un usuario existente");
    }

    public function View($alertMessage = "")
    {
        require_once(VIEWS_PATH . "RegisterView.php");
    }
}
