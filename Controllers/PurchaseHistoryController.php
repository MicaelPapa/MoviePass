<?php

namespace Controllers;
use DAO\TicketsDAO as TicketsDAO;

class PurchaseHistoryController 
{
    private $ticketDAO;

    public function __construct()
    {
        $this->ticketDAO = new TicketsDAO();
    }

    public function View(){
        $this->LoadOrders();
    }

    private function LoadOrders()
    {
        $Orders = $this->ticketDAO->LoadOrders($_SESSION['User']['IdUser'], null);

        foreach ($Orders as $order) {
            $order['seats'] = $this->ticketDAO->GetSeatsFromTickets($order['idorder']);
        }
        require_once(VIEWS_PATH . "TicketsView.php");
    }
}
