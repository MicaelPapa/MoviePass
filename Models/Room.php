<?php 
namespace Models;

class Room 
{
    private $idRoom;
    private $roomNumber;
    private $capacity;
    private $idCinema;

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

    
    public function getIdCinema()
    {
        return $this->idCinema;
    }

  
    public function setIdCinema($idCinema)
    {
        $this->idCinema = $idCinema;

        return $this;
    }

    /**
     * Get the value of capacity
     */ 
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
}


?>