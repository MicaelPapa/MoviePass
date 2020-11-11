<?php

namespace Controllers;

use DAO\CitiesDAO as CitiesDAO;
use DAO\MoviesDAO as MoviesDAO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\RoomDAO as RoomDAO;
use DAO\ScreeningDAO as ScreeningDAO;
use DAO\PurchaseDAO as PurchaseDAO;

use Models\Screening as Screening;

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
            $screening = $this->LoadScreeningToPuchase($idScreening);
            require_once(VIEWS_PATH . "PurchaseView.php");
        } else {
            require_once(VIEWS_PATH . "LoginView.php");
        }
    }

    public function LoadScreeningToPuchase($idScreening)
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

    private function ValidatePay($name,$number,$cvc,$month,$year,$cantEntradas,$idScreening)
		{
            $cantEntradas = $cantEntradas;
            $idScreening = $idScreening;
            $this->BuyTickets($cantTickets,$idScreening);           
		}
		

    public function BuyTickets($cantTickets,$idScreening) 
    {

        $screening = $this->LoadScreeningToPuchase($idScreening);

        if (isset($_SESSION['isLogged'])) {
            if (count($_POST, COUNT_NORMAL) > 0) {
                $this->PurchaseDAO->BuyTickets($screening, $_SESSION['User']['IdUser'],$cantTickets);
                HomeController::Index(); // tiene que mandarte a vista intermedia con compra exitosa/ email enviado
            }
        } else {
            require_once(VIEWS_PATH . "LoginView.php");
        }
    }
}