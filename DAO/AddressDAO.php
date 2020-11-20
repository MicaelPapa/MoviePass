<?php

namespace DAO;

use Models\User as User;
use Models\Address as Address;
use DAO\Connection as Connection;
use Interfaces\IAddressDAO as IAddressDAO;

class AddressDAO implements IAddressDAO
{
    private $connection;
    private $tableName = "Addresses";
    


    public function GetAll()
    {
        $query = "SELECT * FROM " . $this->tableName . ";";
        
        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query);
        $parameters = array();
        try{

            foreach ($result as $row) {
                $address = new Address();
                $address->setIdAddress($row["IdAddress"]);
                $address->setStreet($row["Street"]);
                $address->setNumberStreet($row["NumberStreet"]);
       
    
                array_push($parameters, $address);
            }
            return $parameters;
        }
        catch (Exception $ex) {
            throw $ex;
        }

    }



    public function getAddressById($idAddress){

        $query = "SELECT * FROM " . $this->tableName . " WHERE IdAddress = " . $idAddress . " ;";


        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query);

        try{

            foreach ($result as $row) {
                $address = new Address();
                $address->setIdAddress($row["IdAddress"]);
                $address->setStreet($row["Street"]);
                $address->setNumberStreet($row["NumberStreet"]);                
                return $address;
            }
            
        }
        catch (Exception $ex) {
            throw $ex;
        }
    }

    
    public function getAddressByCinema($cinema){

        $query = "SELECT * FROM " . $this->tableName . " WHERE IdAddress = " . $idAddress . " ;";


        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query);

        try{

            foreach ($result as $row) {
                $address = new Address();
                $address->setIdAddress($row["IdAddress"]);
                $address->setStreet($row["Street"]);
                $address->setNumberStreet($row["NumberStreet"]);                
                return $address;
            }
            
        }
        catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Add($address){
       
        try{
            $query = "INSERT INTO " . $this->tableName . " ( Street, NumberStreet) VALUES ( :Street, :NumberStreet);";

            $parameters["Street"] = $address->getStreet();
            $parameters["NumberStreet"] = $address->getNumberStreet();
            $this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters);

            $query = "SELECT MAX(IdAddress) as 'IdAddress' FROM ". $this->tableName . " ;";
            
            $this->connection = Connection::GetInstance();
            $result =  $this->connection->Execute($query);
            
           foreach($result as $row)
            {
                $idAddress = null;
                $idAddress = $row["IdAddress"];
                return $idAddress;
            }        
        }
        
        catch (Exception $ex) {
        throw $ex;
        }
    }

    public function getIdFromDataBase($street, $numberStreet){
        
        $query = "SELECT * FROM " . $this->tableName . " WHERE Street = " . $street . " and  NumberStreet = " . $numberStreet . " ;";
        $parameters = array();
        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query, $parameters, QueryType::Query);

        try{

            foreach ($result as $row) {
                $address = new Address();
                $address->setIdAddress($row["IdAddress"]);

    
            }
            return $address;
        }
        catch (Exception $ex) {
            throw $ex;
        }
    }
}
    