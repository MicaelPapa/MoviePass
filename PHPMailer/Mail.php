<?php
namespace PHPMailer;
require_once 'PHPMailer.php';
require_once 'SMTP.php';
require_once 'Exception.php';

use Util\Random as Random;
use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    private static function InitMail($destinationMail){
        $mail = new PHPMailer();
        
        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.gmail.com:465'; //tls://smtp.gmail.com:587
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_MP;
        $mail->Password = MAIL_PASS;
        $mail->Port = '465'; //587
        $mail->SMTPSecure = 'ssl'; //tls

        //EMAIL Settings
        $mail->isHTML(true);
        $mail->setFrom('no-reply-info.moviepass@gmail.com');
        $mail->addAddress($destinationMail);

        return $mail;
    }

    public static function SendConfirmationCode($name, $destinationMail)
    {
        $mail = Mail::InitMail($destinationMail);
        $confirmationCode = Random :: CreateRandomNumber(20);
        
        $mail->Subject = 'Bienvenido a MoviePass ' . $name . '!';
        $mail->Body = 'Codigo: ' . $confirmationCode;

        if ($mail->send())
            return true;
        else
            return false;
    }

    public static function SendNewPassword($destinationMail,$name,$newPassword)
    {
        $mail = Mail::InitMail($destinationMail);

        $mail->header = 'Esta es su nueva contraseña!';
        $mail->Subject = 'Para ' . $name;
        $mail->Body = 'Nueva contraseña: ' . $newPassword . '.<br>
        O bien puede conservarla, o luego puede cambiarla al iniciar sesión desde configuraciones.';

        if ($mail->send())
            return true;
        else
            return false;
    }

    public static function SendContactMail($subject,$email,$name,$lastName,$description)
    {
        $mail = Mail::InitMail(MAIL_MP);

        $mail->header = 'Mensaje del Usuario:  ';
        $mail->Subject = $subject ;
        $mail->Body = "Nombre: " . $name . "<br>Apellido: " . $lastName ."<br>Email: " . $email. "<br>Consulta: " . $description;

        if ($mail->send())
        return true;
    else
        return false;
    }

    public static function sendTicket($destinationMail, $name, $cinemaName, $movieName, $roomName, $date, $hour, $qr)
    {
        $mail = Mail::InitMail($destinationMail);

        $mail->header = $cinemaName . ' Tickets';
        $mail->Subject = $cinemaName . ' Tickets' ;
        $mail->Body = "Pelicula: " . $movieName ."<br>Fecha y horario de la funcion: ".$date." ".$hour. "<br>SALA : " . $roomName . "
         <br><br>Cine:  " . $cinemaName . " <td bgcolor='#fff' style='color:#666; text-align:center; font-size:13px; padding:20px 0px 20px 40px; line-height:25px; border-radius:0 30px 30px 0;' valign='middle' width='50%' class=''>
         <center><img src='https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=". $qr. " style='display:block'></center>
         </td><br>Esperamos que disfruten la pelicula " . $name . ".";

        if ($mail->send())
        return true;
    else
        return false;
    }
}
