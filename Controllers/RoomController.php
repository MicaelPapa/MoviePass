<?php

namespace Controllers;

use Models\Room as Room;
use Models\Cinema as Cinema;
use DAO\RoomDAO as RoomDAO;
use DAO\CinemaDAO as CinemaDAO;
use Util\Validate as Validate;
use Controllers\HomeController as HomeController;
use Controllers\CinemaController as CinemaController;

class RoomController
{
    private $roomDAO;
    private $cinemaDAO;

    function __construct()
    {
        $this->RoomDAO = new RoomDAO();
        $this->cinemaDAO = new CinemaDAO();
    }

    public function Add($roomNumber, $capacity, $cinemaName)
    {

        $roomNumber = Validate::ValidateData($roomNumber);
        $capacity = Validate::ValidateData($capacity);

        $cinema = new Cinema();
        $cinema = $this->cinemaDAO->getCinemaByName($cinemaName);

        $room = new Room();
        $room->setRoomNumber($roomNumber);
        $room->setCapacity($capacity);
        $room->setCinema($cinema);
        $this->RoomDAO->Add($room, $cinema);

        $cinemaList = $this->cinemaDAO->GetAll();

        require_once(VIEWS_PATH . "CinemaListView.php");
    }

    public  function ShowAddView($idCinema)
    {

        $cinema =  $this->cinemaDAO->GetCinemaById($idCinema);
        require_once(VIEWS_PATH . "AddRoomView.php");

        //CinemaController::ShowCinemaList();     
    }


    public function ShowEditView($idRoom)
    {

        if (Validate::Logged() && Validate::AdminLog()) {
            $room = new Room();
            $room = $this->RoomDAO->GetRoomById($idRoom);

            $idCinema = $this->RoomDAO->getIdCinema($idRoom);
            $cinema = $this->cinemaDAO->GetCinemaById($idCinema);

            $room->setCinema($cinema);

            require_once(VIEWS_PATH . "EditRoomView.php");
        } else {
            HomeController::Index();
        }
    }


    public function Update($roomNumber, $capacity, $idRoom)
    {

        //validar admin 
        $roomNumber = Validate::ValidateData($roomNumber);
        $capacity = Validate::ValidateData($capacity);


        $this->RoomDAO->UpdateRoom($idRoom, $roomNumber, $capacity);

        $idCinema = $this->RoomDAO->getIdCinema($idRoom);
        $this->ShowListView($idCinema);
    }

    public function ShowListView($idCinema)
    {

        $roomList = $this->RoomDAO->GetRoomsByCinema($idCinema);

        $cinema = $this->cinemaDAO->GetCinemaById($idCinema);
        require_once(VIEWS_PATH . "RoomListView.php");
    }

    public function Remove($idRoom)
    {

        $idRoom = Validate::ValidateData($idRoom);
        $room = new Room();
        $room->setIdRoom($idRoom);

        $idCinema = $this->RoomDAO->GetIdCinema($idRoom);
        $this->RoomDAO->Remove($room);





        $this->ShowListView($idCinema);
    }
}
