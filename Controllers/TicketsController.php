<?php

namespace Controllers;

use Models\Screening as Screening;
use DAO\MoviesDAO as MoviesDAO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\RoomDAO as RoomDAO;
use DAO\UserDAO as UserDAO;
use DAO\ScreeningDAO as ScreeningDAO;
use DAO\TicketsDAO as TicketsDAO;

class TicketsController
{
    private $ticketDAO;
    private $MoviesDAO;
    private $CinemasDAO;
    private $ScreeningDAO;

    public function __construct()
    {
        $this->ticketDAO = new TicketsDAO();
        $this->MoviesDAO = new MoviesDAO();
        $this->CinemaDAO = new CinemaDAO();
        $this->ScreeningDAO = new ScreeningDAO();
        $this->RoomDAO = new RoomDAO();
    }

    public function View($orderType)
    {
        if(isset($_SESSION['isLogged'])){
            $this->LoadOrders($orderType);
        }
        else {
            require_once(VIEWS_PATH . "LoginView.php");
        }
    }

    private function LoadOrders($orderType)
    {   
        if($orderType === "name"){
            $tickets = $this->ticketDAO->getTicketsOrderedByMovie($_SESSION['User']['IdUser']);
            foreach ($tickets as $ticket) {
                $screening = new Screening();
                $screening = $this->LoadScreeningToTicket($ticket->getScreening()->getIdScreening());
                $ticket->setScreening($screening);
            } 
        }else if($orderType === "date"){
            $tickets = $this->ticketDAO->getTicketsOrderedByDate($_SESSION['User']['IdUser']);
            foreach ($tickets as $ticket) {
                $screening = new Screening();
                $screening = $this->LoadScreeningToTicket($ticket->getScreening()->getIdScreening());
                $ticket->setScreening($screening);
            } 
        }else{
            $tickets = $this->ticketDAO->getTicketsByUser($_SESSION['User']['IdUser']);
            foreach ($tickets as $ticket) {
                $screening = new Screening();
                $screening = $this->LoadScreeningToTicket($ticket->getScreening()->getIdScreening());
                $ticket->setScreening($screening);
            }
        }

        require_once(VIEWS_PATH . "TicketsView.php");
    }

    public function LoadScreeningToTicket($idScreening)
    {
        $screening = new Screening();
        $screening = $this->ScreeningDAO->GetScreeningById($idScreening);
        $movie = $this->MoviesDAO->getByMovieId($screening->getMovie()->getIdMovie());
        $cinema = $this->CinemaDAO->GetCinemaById($screening->getCinema()->getIdCinema());
        $room = $this->RoomDAO->getRoomById($screening->getRoom()->getIdRoom());

        $screening->setCinema($cinema);
        $screening->setMovie($movie);
        $screening->setRoom($room);
        
        return $screening;

    }

}
