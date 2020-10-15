<?php

namespace DAO;

use DAO\Connection as Connection;
use Interfaces\ITicketsDAO as ITicketsDAO;

class TicketsDAO implements ITicketsDAO
{
    private $connection;
    private $tableName = "tickets";

    public function LoadOrders($userId, $todayDate)
    {
        $invokeStoredProcedure = 'CALL GetOrdersByUser(?,?)';
        $parameters["UserId"] = $userId;
        $parameters["TodayDate"] = $todayDate; //Cuando viene en null trae todas las compras historicamente

        $this->connection = Connection::GetInstance();
        return $this->connection->Execute($invokeStoredProcedure, $parameters, QueryType::StoredProcedure);
    }

    public function BuyTickets($idCine, $idUser, $idFuncion, $cantTickets)
    {
        $capacity = GetCinemaCapacity($idFuncion);
        
        if ($capacity[0]['Capacity'] >= $cantTickets) {
            $invokeStoredProcedure = 'CALL BuyTickets(?,?,?,?)';
            $parameters["IdCine"] = $idCine;
            $parameters["IdUser"] = $idUser;
            $parameters["IdFuncion"] = $idFuncion;
            $parameters["CantTickets"] = $cantTickets;

            $this->connection = Connection::GetInstance();
            $this->connection->Execute($invokeStoredProcedure, $parameters, QueryType::StoredProcedure);
        }
    }

    public function GetCinemaCapacity($idFuncion)
    {
        $invokeStoredProcedure = 'CALL GetCapacityPerScreening(?)';
        $parameters["IdFuncion"] = $idFuncion;
        $this->connection = Connection::GetInstance();
        return $this->connection->Execute($invokeStoredProcedure, $parameters, QueryType::StoredProcedure);
    }

    public function GetSeatsFromTickets($idOrder)
    {
        $seats = "";
        $query = "SELECT tickets.idseatrow,tickets.idseatcol FROM " . $this->tableName .
            " WHERE tickets.idorder = :OrderId";

        $parameters["OrderId"] = $idOrder;

        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query, $parameters, QueryType::Query);

        foreach ($result as $item) {
            $seats += $item;
        }

        return $seats;
    }
}
