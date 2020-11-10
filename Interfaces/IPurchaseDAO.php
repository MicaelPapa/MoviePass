<?php 
namespace Interfaces;

interface IPurchaseDAO
{
    public function BuyTickets($screening, $idUser,  $cantTickets);
   
}
?>