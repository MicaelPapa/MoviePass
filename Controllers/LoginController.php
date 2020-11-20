<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use Exception;
use PHPMailer\Mail as Mail;
use Models\User as User;
use Util\Validate as Validate;
use Util\Hash as Hash;
use Util\Random as Random;

class LoginController
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    #region: LOGIN

    public function facebookIndex($user)
    {
        $_SESSION['User'] = $user;
        $_SESSION['isLogged'] = true;
        HomeController::Index();
    }

    public function Index($email, $pass)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = Validate::ValidateData($email);
            $password = Validate::ValidateData($pass);

            try {
                $password = Hash::Hashing($password);
                $selectedUser = $this->userDAO->LogIn($user, $password);

                if ($selectedUser != null) {
                    $_SESSION['User'] = $selectedUser[0];
                    $_SESSION['isLogged'] = true;
                    if ($selectedUser[0]['IsAdmin']) {
                        $_SESSION['isAdmin'] = true;
                    }
                    HomeController::Index();
                } else {
                    $this->View("Email o contraseña incorrecta");
                }
            } catch (Exception $e) {
                $this->View("Ha ocurrido un error al intentar iniciar sesion");
            }
        } else {
            $this->View();
        }
    }

    public function LogInWithFacebookHandler()
    {
        require_once(FACEBOOK_CUSTOM_PATH . "fblogin.php");
    }

    public function RecoverPassword($email)
    {
        $email = Validate::ValidateData($email);

        try {
            $selectedUser = new User();
            $selectedUser = $this->userDAO->SearchUserByEmail($email);
            $newPassword = Random::CreateRandomNumber(10);

            if ($selectedUser != null) {
                if (Mail::SendNewPassword($email, $selectedUser[0]["UserName"], $newPassword)) {
                    $this->View("Hemos enviado una nueva contraseña a su email, luego puede cambiarla en 
                    configuraciones al iniciar sesión si asi lo desea");
                } else {
                    $this->ShowForgotPasswordView("Ha ocurrido un error al enviar la nueva contraseña");
                }
                $selectedUser['NewPassword'] = $this->userDAO->UpdateUserPassword($email, Hash::Hashing($newPassword));
            } else {
                $this->ShowForgotPasswordView("Ese email no pertenece a ningun usuario registrado en MoviePass");
            }
        } catch (Exception $e) {
            $this->ShowForgotPasswordView("Ha ocurrido un error al intentar recuperar la contraseña");
        }
    }

    public function ShowForgotPasswordView($alertMessage = "")
    {
        require_once(VIEWS_PATH . "ForgotPasswordView.php");
    }

    public function View($alertMessage = "")
    {
        require_once(VIEWS_PATH . "LoginView.php");
    }

    public function Logout()
    {   $_SESSION['isLogged'] = false;
        session_destroy();
        $this->View();
    }
}
