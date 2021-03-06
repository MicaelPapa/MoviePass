<?php

namespace Controllers;

use DAO\CinemaDAO as CinemaDAO;
use DAO\RoomDAO as RoomDAO;
use DAO\AddressDAO as AddressDAO;
use Models\Movie as Movie;
use Models\Cinema as Cinema;
use Models\Room as Room;
use Exception;
use Util\ApiResponse;
use Util\Validate;
use Controllers\HomeController as HomeController;
use Models\Address as Address;

class CinemaController
{
    private $CinemaDAO;
    private $RoomDAO;
    private $AddressDAO;

    function __construct()
    {
        $this->CinemaDAO = new CinemaDAO();
        $this->RoomDAO = new RoomDAO();
        $this->AddressDAO = new AddressDAO();
    }


    public function ShowListView($alertMessage = "")
    {
        $cinemaList =  $this->GetAll();
        require_once(VIEWS_PATH . "CinemaListView.php");
    }

    public function ShowAddView($alertMessage = "", $alertType = "")
    {
        if (Validate::Logged() && Validate::AdminLog()) {

            require_once(VIEWS_PATH . "AddCinemaView.php");
        } else {
            HomeController::Index();
        }
    }



    public function ShowEditView($idCinema)
    {

        if (Validate::Logged() && Validate::AdminLog()) {
            $cinema = new Cinema();
            $cinema = $this->CinemaDAO->GetCinemaById($idCinema);
            $address = $this->AddressDAO->getAddressById($cinema->getAddress()->getIdAddress());
            $cinema->setAddress($address);

            require_once(VIEWS_PATH . "EditCinemaView.php");
        } else {
            HomeController::Index();
        }
    }

    public function Add($cinemaName, $street, $numberStreet)
    {
        if (Validate::Logged() && Validate::AdminLog()) {

            $cinemaName = Validate::ValidateData($cinemaName);
            $street = Validate::ValidateData($street);
            $numberStreet = Validate::ValidateData($numberStreet);


            if ($this->CinemaDAO->getCinemaByName($cinemaName)) {
                $this->ShowAddView("Cine ya existente", "danger");
            } else {
                $address = new Address();
                $address->setStreet($street);
                $address->setNumberStreet($numberStreet);
                $cinema = new Cinema();
                $cinema->setCinemaName($cinemaName);
                $address  =  $this->CinemaDAO->Add($cinema, $address);
                $cinema->setAddress($address);
                require_once(VIEWS_PATH . "AddRoomView.php");
            }
        } else {

            HomeController::Index();
        }
    }

    public function Remove($idCinema)
    {
        if (Validate::Logged() && Validate::AdminLog()) {
            $idCinema = Validate::ValidateData($idCinema);

            $cinema = new Cinema();
            $cinema->setIdCinema($idCinema);
            $this->CinemaDAO->remove($cinema);

            $this->ShowListView();
        } else {
            HomeController::Index();
        }
    }

    public function Update($cinemaName, $street, $number, $idCinema)
    {

        $cinemaName = Validate::ValidateData($cinemaName);
        $street = Validate::ValidateData($street);
        $number = Validate::ValidateData($number);
        $address = new Address();
        $address->setStreet($street);
        $address->setNumberStreet($number);
        $idAddress = $this->AddressDAO->Add($address);
        $address->setIdAddress($idAddress);

        $this->CinemaDAO->UpdateCinema($idCinema, $cinemaName, $address);
        $this->ShowListView();
    }

    public function SelectCinema($view)
    {
        $viewName = $view;
        $cinemaList = $this->CinemaDAO->GetAll();
        require_once(VIEWS_PATH . "SelectCinemaView.php");
    }

    public function GetAddressFromList($addressList, $id)
    {

        return  $this->CinemaDAO->GetAddress($addressList, $id);
    }

    public function GetRoomsFromList($roomList, $id)
    {

        return  $this->CinemaDAO->getRooms($roomList, $id);
    }

    public function GetAll()
    {

        return $this->CinemaDAO->GetAll();
    }
}
