<?php

namespace DAO;

use Models\Screening as Screening;
use Models\User as User;
use Models\Order as Order;
use Models\Purchase as Purchase;
use DAO\Connection as Connection;
use Interfaces\ITicketsDAO as ITicketsDAO;

class TicketsDAO implements ITicketsDAO
{
    private $connection;
    private $tableName = "tickets";
    private $tableOrders = "orders";

    public function LoadTickets($qr,$idUser,$screening,$idOrder,$cantTickets)
    {   
        try{
            for($i = 0; $i < $cantTickets; $i ++) {
                $query = "INSERT INTO " . $this->tableName . " (QrCode,IdUser,IdScreening,IdOrder) VALUES (:QrCode, :IdUser, :IdScreening,:IdOrder);";
    
                $parameters["QrCode"] = $qr;
                $parameters["IdUser"] = $idUser;
                $parameters["IdScreening"] = $screening->getIdScreening();
                $parameters["IdOrder"] = $idOrder;
    
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
        } catch (Exception $ex) {
            return null;
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
				$purchase->setIdPurchase($row["IdTicket"]);
                $screening = new Screening();
                $screening->setIdScreening($row["IdScreening"]);
                $purchase->setScreening($screening);
                array_push($results, $purchase);
            }  
            return $results;      
        } catch (Exception $ex) {
			    return null;
            }
    }
    public function getTicketsByIdOrder($order){
        try{
            $query = "SELECT * FROM " . $this->tableName . " WHERE IdOrder = " . $order->getIdOrder() . " ;";
            $this->connection = Connection::GetInstance();
            $resultList = $this->connection->Execute($query); 
            $results = array();

            foreach ($resultList as $row) {
				$purchase = new Purchase();
				$purchase->setIdPurchase($row["IdTicket"]);
                $screening = new Screening();
                $screening->setIdScreening($row["IdScreening"]);
                $purchase->setScreening($screening);
                array_push($results, $purchase);
            }  
            return $results;      
        } catch (Exception $ex) {
			    return null;
            }
    }
}
