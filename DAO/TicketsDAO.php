<?php

namespace DAO;

use Models\Screening as Screening;
use Models\User as User;
use Models\Purchase as Purchase;
use DAO\Connection as Connection;
use Interfaces\ITicketsDAO as ITicketsDAO;

class TicketsDAO implements ITicketsDAO
{
    private $connection;
    private $tableName = "orders";

    public function BuyTickets($screening,$cantTickets)
    {
       // $capacity = GetCinemaCapacity($idFuncion);
        
       $remainTickets = $screening->getRemainTickets();

        if ($capacity[0]['Capacity'] >= $cantTickets) {
            $invokeStoredProcedure = 'CALL BuyTickets(?,?,?,?)'; //agregar que se resten los remain tickets
            $parameters["IdCine"] = $idCine;
            $parameters["IdUser"] = $idUser;
            $parameters["IdFuncion"] = $idFuncion;
            $parameters["CantTickets"] = $cantTickets;

            $this->connection = Connection::GetInstance();
            $this->connection->Execute($invokeStoredProcedure, $parameters, QueryType::StoredProcedure);
        }
    }


    public function getTicketsByUser($idUser){
        try{
            $query = "SELECT * FROM " . $this->tableName . " WHERE IdUser = " . $idUser . " ;";
            $this->connection = Connection::GetInstance();
            $resultList = $this->connection->Execute($query); 
            $results = array();

            foreach ($resultList as $row) {
				$purchase = new Purchase();
				$purchase->setIdPurchase($row["IdOrder"]);
				$purchase->setSubTotal($row["SubTotal"]);
				$purchase->setTotal($row["Total"]);
				$purchase->setDate($row["DatePurchase"]);
                $purchase->setDiscount($row["Discount"]);
                $screening = new Screening();
                $screening->setIdScreening($row["IdScreening"]);
                $purchase->setScreening($screening);
				$purchase->setCantTickets($row["cantTickets"]);
                array_push($results, $purchase);
            }  
            return $results;      
        } catch (Exception $ex) {
			    return null;
            }
    }
}
