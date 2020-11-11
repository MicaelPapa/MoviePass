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

    public function ViewCreditCard($cantEntradas, $idScreening){
        $cantEntradas = $cantEntradas;
        $idScreening = $idScreening;
        require_once(VIEWS_PATH . "creditCardView.php");
    }

    public function ValidatePay($name,$apellido,$number,$cvc,$month,$year,$cantEntradas,$idScreening)
		{
            $cantEntradas = $cantEntradas;
            $idScreening = $idScreening;
            $this->BuyTickets($cantEntradas,$idScreening);           
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