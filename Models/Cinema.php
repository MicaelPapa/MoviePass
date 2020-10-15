<?php

namespace Models;


class Cinema
{
    private $idCinema;
    private $CinemaName;
    private $IdAddress;
    private $Address;
    private $Rooms;

    
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
        return $this->CinemaName;
    }

 
    public function setCinemaName($CinemaName)
    {
        $this->CinemaName = $CinemaName;

        return $this;
    }


    /**
     * Get the value of IdAddress
     */ 
    public function getIdAddress()
    {
        return $this->IdAddress;
    }

    /**
     * Set the value of IdAddress
     *
     * @return  self
     */ 
    public function setIdAddress($IdAddress)
    {
        $this->IdAddress = $IdAddress;

        return $this;
    }

    public function getAddress()
    {
        return $this->Address;
    }

 
    public function setAddress($Address)
    {
        $this->Address = $Address;

        return $this;
    }

    public function getRooms()
    {
        return $this->Rooms;
    }

 
    public function setRooms($Rooms)
    {
        $this->Rooms = $Rooms;

        return $this;
    }
}
