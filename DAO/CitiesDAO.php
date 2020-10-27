<?php

namespace DAO;
use DAO\Connection as Connection;
use Models\State as State;
use Models\Country as Country;
use Models\City as City;
use Interfaces\ICitiesDAO as ICitiesDAO;


class CitiesDAO implements ICitiesDAO
{
	private $connection;
    private $tableName = "cities";
    private $stateTableName = "states";
    private $countryTableName = "countries";

    public function GetAll()
    {
        $query = "SELECT * FROM " . $this->tableName . ";";
        $parameters = array();
        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query, $parameters, QueryType::Query);

        try{

            foreach ($result as $row) {
                $city = new City();
                $city->setIdCity($row["IdCity"]);
                $city->setCityName($row["CityName"]);
                $city->setZipCode($row["ZipCode"]);
                $city->setIdState($row["IdState"]);
    
                array_push($parameters, $city);
            }
            return $parameters;
        }
        catch (Exception $ex) {
            throw $ex;
        }

    }

    public function GetAllStates()
    {
        $query = "SELECT * FROM " . $this->stateTableName . ";";
        $parameters = array();
        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query, $parameters, QueryType::Query);

        try{

            foreach ($result as $row) {
                $state = new State();
                $state->setIdState($row["IdState"]);
                $state->setStateName($row["StateName"]);
    //            $state->setIdCountry($row["IdCountry"]);
    
                array_push($parameters, $state);
            }
            return $parameters;
        }
        catch (Exception $ex) {
            throw $ex;
        }

    }

    public function getCitiesObjectByState($idState){
        $query = "SELECT * FROM " . $this->tableName . " WHERE IdState = " . $idState . " ;";
        $parameters = array();
        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query, $parameters, QueryType::Query);

        try{

            foreach ($result as $row) {
                $city = new City();
                $city->setIdCity($row["IdCity"]);
                $city->setCityName($row["CityName"]);
                $city->setZipCode($row["ZipCode"]);
                $city->setIdState($row["IdState"]);

                array_push($parameters, $city);
            }
            return $parameters;
        }
        catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getCitiesByState($idState){
        $query = "SELECT * FROM " . $this->tableName . " WHERE IdState = " . $idState . " ;";
        $parameters = array();
        $this->connection = Connection::GetInstance();
        return $this->connection->Execute($query, $parameters, QueryType::Query);
    }

    public function getIdCitiesByName($cityName){
        
        $query = "SELECT * FROM " . $this->tableName . " WHERE CityName = " . $cityName . " ;";
        $parameters = array();
        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query, $parameters, QueryType::Query);

        try{

            foreach ($result as $row) {
                $city = new City();
                $city->setIdCity($row["IdCity"]);
                $city->setCityName($row["CityName"]);
                $city->setZipCode($row["ZipCode"]);
                $city->setIdState($row["IdState"]);
    
            }
            return $city;
        }
        catch (Exception $ex) {
            throw $ex;
        }
    }
  
    public function getState($idState){
       
        try{
        $query = "SELECT * FROM " . $this->stateTableName . " WHERE IdState = " . $idState . " ;";
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query);

		foreach ($resultSet as $row) {
                
            $state = new State();

            $state->setIdState($row["IdState"]);
            $state->setStateName($row["StateName"]);
            $state->setIdCountry($row["IdCountry"]);

            return $state;
            }
        }
	    catch (Exception $ex) {
			return null;
		}  

    }

    public function getCity($idCity){
       
        try{
        $query = "SELECT * FROM " . $this->tableName . " WHERE IdCity = " . $idCity . " ;";
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query);

		foreach ($resultSet as $row) {
                
            $city = new City();

            $city->setIdCity($row["IdCity"]);
            $city->setCityName($row["CityName"]);
            $city->setZipCode($row["ZipCode"]);
            $city->setIdState($row["IdState"]);

            return $city;
            }
        }
	    catch (Exception $ex) {
			return null;
		}  

    }

    public function getStateByCountry($idCountry){
       
        try{
        $query = "SELECT * FROM " . $this->stateTableName . " WHERE IdCountry = " . $idCountry . " ;";
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query);
        $parameters = array(); 

		foreach ($resultSet as $row) {
                
            $state = new State();

            $state->setIdState($row["IdState"]);
            $state->setStateName($row["StateName"]);
            $state->setIdCountry($row["IdCountry"]);
            array_push($parameters, $state);
        }
        return $parameters;
        }
	    catch (Exception $ex) {
			return null;
		}
    }

    public function getCountry($idCountry){
        try{
        $query = "SELECT * FROM " . $this->countryTableName . " WHERE IdCountry = " . $idCountry . " ;";
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query);

		foreach ($resultSet as $row) {
                
            $city = new City();

            $city->setIdCountry($row["IdCountry"]);
            $city->setCountryName($row["CountryCode"]);
            $city->setCountryCode($row["CountryCode"]);

            return $city;
            }
        }
	    catch (Exception $ex) {
			return null;
        }

    }
        
    public function getAllCountries(){
            
        $query = "SELECT * FROM " . $this->countryTableName . ";";
        $parameters = array();
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query, $parameters, QueryType::Query);

        try{

            foreach ($resultSet as $row) {
                $country = new Country();
                $country->setIdCountry($row["IdCountry"]);
                $country->setCountryName($row["CountryName"]);
                $country->setCountryCode($row["CountryCode"]);
    
                array_push($parameters, $country);
            }
            return $parameters;
        }
        catch (Exception $ex) {
            throw $ex;
        }
    }
}

?>

