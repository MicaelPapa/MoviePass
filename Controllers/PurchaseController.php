<?php

namespace Controllers;

use DAO\CitiesDAO as CitiesDAO;
use DAO\MoviesDAO as MoviesDAO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\RoomDAO as RoomDAO;
use DAO\ScreeningDAO as ScreeningDAO;
use DAO\PurchaseDAO as PurchaseDAO;
use DAO\TicketsDAO as TicketsDAO;
use Models\Screening as Screening;
use Models\Purchase as Purchase;
use Models\Order as Order;
use Models\User as User;
use PHPMailer\Mail as Mail;
use Util\Validate;
use Util\CreditCard;

class PurchaseController
{
    private $CitiesDAO;
    private $MoviesDAO;
    private $CinemasDAO;
    private $ScreeningDAO;
    private $PurchaseDAO;
    private $TicketsDAO;

    public function __construct()
    {
        $this->MoviesDAO = new MoviesDAO();
        $this->CinemaDAO = new CinemaDAO();
        $this->ScreeningDAO = new ScreeningDAO();
        $this->PurchaseDAO = new PurchaseDAO();
        $this->RoomDAO = new RoomDAO();
        $this->TicketsDAO = new TicketsDAO();
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

    public function ViewCreditCard($cantEntradas, $idScreening, $alertMessage = " ", $alertType = " "){
        $cantEntradas = $cantEntradas;
        $idScreening = $idScreening;
        require_once(VIEWS_PATH . "creditCardView.php");
    }

    public function ValidatePay($name,$number,$cvc,$month,$year,$cantEntradas,$idScreening)
		{
            $cantEntradas = $cantEntradas;
            $idScreening = $idScreening;
            $mmyy = $month . "/" . $year;

            $name = Validate::ValidateData($name);
			$mmyy = Validate::ValidateData($mmyy);
			$number = Validate::ValidateData($number);
            $cvc = Validate::ValidateData($cvc);
            
			if(!$this->validateCreditCard($name,$mmyy,$number,$cvc)){

				$this->ViewCreditCard($cantEntradas, $idScreening, "Los datos de la tarjeta son incorrectos.", "warning");
            }else{
                $this->BuyTickets($cantEntradas,$idScreening);
            }      
        }
        
        private function validateCreditCard($name,$mmyy,$number,$cvc)
		{
			//Validamos numeros de la tarjeta
			$validateCard = CreditCard::validCreditCard($number);
			if($validateCard['valid'] == false) return false;

			//Validamos codigo de seguridad
			$validateCvc = CreditCard::validCvc($cvc, $validateCard['type']);
			if($validateCvc == false) return false;

			//Validamos fecha de expiracion
			$date = explode("/", $mmyy);
			$validateDate = CreditCard::validDate("20".$date[1], $date[0]);
			if(!$validateDate) return false;

			//Si pasa todas las validaciones procesamos la compra
			return true;
		}

    public function BuyTickets($cantTickets,$idScreening) 
    {

        $screening = $this->LoadScreeningToPurchase($idScreening);

        if (isset($_SESSION['isLogged'])) {
            if (count($_POST, COUNT_NORMAL) > 0) {
                $order = new Order();
                $order->setIdOrder($this->PurchaseDAO->BuyTickets($screening, $cantTickets)); 
                $date = date_create($screening->getStartHour());
                $qr = "Cine:" . $screening->getCinema()->getCinemaName() . " Sala:" . $screening->getRoom()->getRoomNumber() . " Fecha:" . date_format(date_create($screening->getStartDate()),"d/m/Y") . 
                " Hora:" . date_format($date,'h:i:a') . " Código:" . $screening->getIdScreening() . $screening->getCinema()->getIdCinema() . $screening->getRoom()->getIdRoom();
                if($order->getIdOrder())
                {
                    $this->TicketsDAO->LoadTickets($qr,$_SESSION['User']['IdUser'],$screening, $order->getIdOrder(), $cantTickets);
                    $this->successPurchase($order,$screening);
                }
            }
        } else {
            require_once(VIEWS_PATH . "LoginView.php");
        }
    }

    public function successPurchase($order,$screening)
    {
        $ticketList = $this->TicketsDAO->getTicketsByIdOrder($order);
        $order = $this->PurchaseDAO->getPurchase($order);
        foreach($ticketList as $ticket){
            Mail::sendTicket($_SESSION['User']['Email'],$_SESSION['User']['UserName'],$screening->getCinema()->getCinemaName(),$screening->getMovie()->getMovieName(),$screening->getRoom()->getRoomNumber(),$screening->getStartDate(),$screening->getStartHour(),$ticket->getQrCode());
        }
        

        require_once(VIEWS_PATH. "SuccessPurchaseView.php");
    }
}