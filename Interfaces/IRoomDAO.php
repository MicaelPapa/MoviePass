<?php 
namespace Interfaces;

interface IRoomDAO
{
    public function Add($room, $cinema);
    function Remove($room);
    public function GetAll();
    public function GetRoomsByCinema($idCinema);

}




?>