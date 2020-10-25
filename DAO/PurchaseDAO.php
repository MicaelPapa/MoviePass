<?php

namespace DAO;

use Interfaces\IPurchaseDAO as IPuchaseDAO;


class PurchaseDAO implements IPuchaseDAO
{
    public function BuyTickets($idCine, $idUser, $idFuncion, $cantTickets)
    {
        //$capacity = $this->GetCinemaCapacity($idFuncion);

        //if ($capacity[0]['Capacity'] >= $cantTickets) {
            $invokeStoredProcedure = 'CALL BuyTickets(?,?,?,?)';
            $parameters["IdCine"] = $idCine;
            $parameters["IdUser"] = $idUser;
            $parameters["IdFuncion"] = $idFuncion;
            $parameters["CantTickets"] = $cantTickets;

            $this->connection = Connection::GetInstance();
            $this->connection->Execute($invokeStoredProcedure, $parameters, QueryType::StoredProcedure);
        //}
    }

    public function GetCinemaCapacity($idFuncion)
    {
        $invokeStoredProcedure = 'CALL GetCapacityPerScreening(?)';
        $parameters["IdFuncion"] = $idFuncion;
        $this->connection = Connection::GetInstance();
        return $this->connection->Execute($invokeStoredProcedure, $parameters, QueryType::StoredProcedure);
    }
}
?>