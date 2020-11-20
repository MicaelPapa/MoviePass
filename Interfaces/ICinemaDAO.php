<?php 

namespace Interfaces;

interface ICinemaDAO 
{
    public function Add($cinema, $address);
    function Remove($cinema);
    public function GetAll();
    public function GetAddress($addressList, $id);
    public function GetRooms($roomList,$id);
    public function GetCinemaById($idCinema);
    public function UpdateCinema($idCinema, $cinemaName, $address);
    public function getCinemaByName($cinema);
    public function existMoviesInCinema($idCinema);
}





?>