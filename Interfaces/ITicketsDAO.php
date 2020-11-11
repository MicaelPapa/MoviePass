<?php
    namespace Interfaces;

    interface ITicketsDAO
    {
        function BuyTickets($screening,$cantTickets);
        function getTicketsByUser($idUser);
    }
?>