<?php 
namespace Interfaces;

interface IPurchaseDAO
{
    public function BuyTickets($idCine, $idUser, $idFuncion, $cantTickets);
    public function GetCinemaCapacity($idFuncion);
}
?>