<?php

namespace Controllers;


use Util\Validate as Validate;
use PHPMailer\Mail as Mail;
use Controllers\HomeController as HomeController;

class ContactController 
{


    public function Index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            
            $email = Validate :: ValidateData($_POST["Email"]);
            $name = Validate :: ValidateData($_POST["Name"]);
            $lastName = Validate :: ValidateData($_POST["LastName"]);
            $subject = Validate :: ValidateData($_POST["Subject"]);
            $description = Validate :: ValidateData($_POST["Description"]);

            Mail::SendContactMail($subject,$email,$name,$lastName,$description);

            HomeController :: Index();
        }
        else {
            $this->View();
        }
    }





    public function View($alertMessage = "")
    {
        require_once(VIEWS_PATH . "ContactView.php");
    }
}


?>