<?php

namespace DAO;

use Interfaces\IPurchaseDAO as IPuchaseDAO;
use Models\Purchase as Purchase;
use Models\Order as Order;
use Models\Screening as Screening;
use Models\User as User;

class PurchaseDAO implements IPuchaseDAO

{
    private $tableName = "orders";

    public function BuyTickets($screening, $cantTickets)
    {


        $invokeStoredProcedure = 'CALL BuyTickets(?,?,?)';
        $parameters["IdFuncion"] = $screening->getIdScreening();
        $parameters["CantTickets"] = $cantTickets;
        $parameters["Price"] = $screening->getPrice();

        $query = " SELECT MAX(idOrder) as IdOrder FROM " . $this->tableName . " ;";

        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($invokeStoredProcedure, $parameters, QueryType::StoredProcedure);
        $result = $this->connection->Execute($query);

        foreach ($result as $row) {
            $idPurchase = null;
            $idPurchase = $row["IdOrder"];
            return $idPurchase;
        }
    }

    public function GetPurchase($purchase)

    {
        $query = " SELECT * FROM " . $this->tableName . " WHERE idOrder = ".$purchase->getIdOrder()." ;";

        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query);

        foreach ($result as $value) {
            $order = new Order();
            $purchase->setIdOrder($value["IdOrder"]);
            $purchase->setSubTotal($value["SubTotal"]);
            $purchase->setTotal($value["Total"]);
            $purchase->setDatePurchase($value["DatePurchase"]);
            $purchase->setDiscount($value["Discount"]);
            $purchase->setCantTickets($value["cantTickets"]);

            return $purchase;
        }
    }
}
