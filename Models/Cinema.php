<?php

namespace Models;


class Cinema
{
    private $idCinema;
    private $cinemaName;
    private $address;
  

    
    public function getIdCinema()
    {
        return $this->idCinema;
    }

    public function setIdCinema($idCinema)
    {
        $this->idCinema = $idCinema;

        return $this;
    }

    public function getCinemaName()
    {
        return $this->cinemaName;
    }

 
    public function setCinemaName($cinemaName)
    {
        $this->cinemaName = $cinemaName;

        return $this;
    }


    public function getAddress()
    {
        return $this->address;
    }

 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    public function getRooms()
    {
        return $this->rooms;
    }

 
    public function setRooms($rooms)
    {
        $this->rooms = $rooms;

        return $this;
    }
}
