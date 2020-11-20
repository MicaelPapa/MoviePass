<?php 
namespace Models;

class Room 
{
    private $idRoom;
    private $roomNumber;
    private $capacity;
    private $cinema;

    public function getIdRoom()
    {
        return $this->idRoom;
    }

    public function setIdRoom($idRoom)
    {
        $this->idRoom = $idRoom;

        return $this;
    }

    public function getRoomNumber()
    {
        return $this->roomNumber;
    }

    public function setRoomNumber($roomNumber)
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }
        
    public function getCapacity()
    {
        return $this->capacity;
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getCinema()
    {
        return $this->cinema;
    }

    public function setCinema($cinema)
    {
        $this->cinema = $cinema;

        return $this;
    }
}


?>