<?php

namespace Controllers;

use DAO\CitiesDAO as CitiesDAO;
use DAO\MoviesDAO as MoviesDAO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\RoomDAO as RoomDAO;
use DAO\ScreeningDAO as ScreeningDAO;
use DAO\PurchaseDAO as PurchaseDAO;
use Models\Screening as Screening;
use Models\Purchase as Purchase;
use PHPMailer\Mail as Mail;

class PurchaseController
{
    private $CitiesDAO;
    private $MoviesDAO;
    private $CinemasDAO;
    private $ScreeningDAO;
    private $PurchaseDAO;


    public function __construct()
    {
        $this->CitiesDAO = new CitiesDAO();
        $this->MoviesDAO = new MoviesDAO();
        $this->CinemaDAO = new CinemaDAO();
        $this->ScreeningDAO = new ScreeningDAO();
        $this->PurchaseDAO = new PurchaseDAO();
        $this->RoomDAO = new RoomDAO();
    }

    public function ViewPreSelected($idScreening,$message = "") //falta pasarle el id USer

    {
        if (isset($_SESSION['isLogged'])) {
            $screening = $this->LoadScreeningToPurchase($idScreening);
            require_once(VIEWS_PATH . "PurchaseView.php");
        } else {
            require_once(VIEWS_PATH . "LoginView.php");
        }
    }

    public function LoadScreeningToPurchase($idScreening)
    {
        $screening = new Screening();

        $screening = $this->ScreeningDAO->GetScreeningById($idScreening);

        $movie = $this->MoviesDAO->getByMovieId($screening->getMovie()->getIdMovie());

        $cinema = $this->CinemaDAO->GetCinemaById($screening->getCinema()->getIdCinema());

        $room = $this->RoomDAO->getRoomById($screening->getRoom()->getIdRoom());

        $screening->setCinema($cinema);
        $screening->setMovie($movie);
        $screening->setRoom($room);
        
        return $screening;

    }
    
    public function View($message = "")
    {
        if (isset($_SESSION['isLogged'])) {
            $movies = $this->LoadMovies();
            require_once(VIEWS_PATH . "PurchaseView.php");
        } else {
            require_once(VIEWS_PATH . "LoginView.php");
        }
    }

    public function LoadMovies()
    {
        return $this->MoviesDAO->getAll();
    }

    public function LoadCinemas()
    {

        if (isset($_POST["idMovie"])) {

            $cinemas = $this->CinemasDAO->getCinemasByMovie($_POST['idMovie']);
            $json = json_encode($cinemas);
            echo "$" . $json . "%";
        }
    }

    public function LoadFunciones()
    {

        if (isset($_POST["idCinema"])) {

            $funciones = $this->ScreeningDAO->GetScreeningsByMovieAndCinema($_POST['idMovie'], $_POST['idCinema']);
            $json = json_encode($funciones);
            echo "$" . $json . "%";
        }
    }

    public function Index($functionId)
    {
        if ($_POST)
            if (isset($_SESSION['isLogged'])) {
                $cities = $this->LoadMovies();
                require_once(VIEWS_PATH . "PurchaseView.php");
            } else {
                require_once(VIEWS_PATH . "LoginView.php");
            }
    }

    public function ViewCreditCard($cantEntradas, $precioTotal){
        require_once(VIEWS_PATH . "creditCardView.php");
    }

    public function VerifyCreditCard(){
        $hoy = date("Y-m-d");
        $fechaVencimiento = $_POST['vencimiento'];
        if ($hoy <= $fechaVencimiento) {
            $numero = $_POST['numeroTarjeta'];

            if(preg_match("/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|622((12[6-9]|1[3-9][0-9])|([2-8][0-9][0-9])|(9(([0-1][0-9])|(2[0-5]))))[0-9]{10}|64[4-9][0-9]{13}|65[0-9]{14}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})*$/", $numero)){
                $this->BuyTickets();
            }
            else {
                $alertMessage = "EL numero ingresado es incorrecto";
                $this->ViewCreditCard($alertMessage);
            }
        }
        else {
            $alertMessage = "La fecha de vencimiento es incorrecta";
            $this->ViewCreditCard($alertMessage);
        }

        if(!$this->validatePay($name,$mmyy,$number,$cvc))
        {			
            $params = array();
            array_push($params,$idFuncion);
            array_push($params,$cantidad);
            Functions::flash("Los datos de la tarjeta son incorrectos.","warning");
            Functions::redirect("Compra","Pay",$params);
        }

    }

    private function validatePay($name,$mmyy,$number,$cvc)
		{
			//Validamos numeros de la tarjeta
			$validateCard = CreditCard::validCreditCard($number);
			if($validateCard['valid'] == false) return false;

			//Validamos codigo de seguridad
			$validateCvc = CreditCard::validCvc($cvc, $validateCard['type']);
			if($validateCvc == false) return false;

			//Validamos fecha de expiracion
			$date = explode(" / ", $mmyy);
			$validateDate = CreditCard::validDate("20".$date[1], $date[0]);
			if(!$validateDate) return false;

			//Si pasa todas las validaciones procesamos la compra
			Functions::flash("Tu compra con tarjeta ".$validateCard['type']." fue procesada con éxito.","success");
			return true;
		}
		

    public function BuyTickets($cantTickets,$idScreening) 
    {

        $screening = $this->LoadScreeningToPurchase($idScreening);

        if (isset($_SESSION['isLogged'])) {
            if (count($_POST, COUNT_NORMAL) > 0) {
                $purchase = new Purchase();
                $purchase->setIdPurchase($this->PurchaseDAO->BuyTickets($screening, $_SESSION['User']['IdUser'],$cantTickets)); 
                if($purchase->getIdPurchase())
                {   
                    $this->successPurchase($purchase,$screening);
                }
            }
        } else {
            require_once(VIEWS_PATH . "LoginView.php");
        }
    }

    public function successPurchase($purchase,$screening)
    {
        $purchase = $this->PurchaseDAO->getPurchase($purchase);
        Mail::sendTicket($purchase->getCantTickets(),$_SESSION['User']['Email'],$_SESSION['User']['UserName'],$purchase->getSubTotal(),$screening->getCinema()->getCinemaName(),$screening->getMovie()->getMovieName(),$screening->getRoom()->getRoomNumber(),$purchase->getDiscount(),$screening->getStartDate(),$screening->getStartHour());

        require_once(VIEWS_PATH. "SuccessPurchaseView.php");
    }
}