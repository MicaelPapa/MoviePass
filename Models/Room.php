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

    /**
     * Set the value of capacity
     *
     * @return  self
     */ 
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get the value of cinema
     */ 
    public function getCinema()
    {
        return $this->cinema;
    }

    /**
     * Set the value of cinema
     *
     * @return  self
     */ 
    public function setCinema($cinema)
    {
        $this->cinema = $cinema;

        return $this;
    }
}


?>