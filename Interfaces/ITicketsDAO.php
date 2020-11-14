<?php
    namespace Interfaces;

    interface ITicketsDAO
    {
        function LoadTickets($qr,$idUser,$screening,$idOrder,$cantTickets);
        function getTicketsByUser($idUser);
    }
?>