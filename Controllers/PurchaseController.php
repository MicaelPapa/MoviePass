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

    public function ViewPreSelected($idScreening,$message = "")
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

    }

    public function BuyTickets()
    {
        if (isset($_SESSION['isLogged'])) {
            if (count($_POST, COUNT_NORMAL) > 0) {
                $this->PurchaseDAO->BuyTickets($_POST['inputCine'], $_SESSION['User']['IdUser'], $_POST['inputFuncion'], $_POST['inputCantAsientos'],);
            }
        } else {
            require_once(VIEWS_PATH . "LoginView.php");
        }
    }
}