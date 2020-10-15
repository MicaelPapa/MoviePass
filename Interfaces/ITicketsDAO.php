<?php
    namespace Interfaces;

    interface ITicketsDAO
    {
        function LoadOrders($userId, $todayDate);
        function GetSeatsFromTickets($idOrder);
    }
?>