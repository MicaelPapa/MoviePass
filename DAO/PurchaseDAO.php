<?php

namespace DAO;

use Interfaces\IPurchaseDAO as IPuchaseDAO;


class PurchaseDAO implements IPuchaseDAO
{
    public function BuyTickets($screening, $idUser, $cantTickets)
    {


            $invokeStoredProcedure = 'CALL BuyTickets(?,?,?,?)';
            $parameters["IdUser"] = $idUser;
            $parameters["IdFuncion"] = $screening->getIdScreening();
            $parameters["CantTickets"] = $cantTickets;
            $parameters["Price"] = $screening->getPrice();


            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($invokeStoredProcedure, $parameters, QueryType::StoredProcedure);
        
    }

    
}
?>