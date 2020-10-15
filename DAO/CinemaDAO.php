<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\Cinema as Cinema;


class cinemaDAO
{
	private $connection;
	private $tableName = "cinemas";

	public function Add($cinema, $address)
	{
		try {
			
			$query = "INSERT INTO addresses (Street, NumberStreet, IdCity ) VALUES (:Street, :NumberStreet, :IdCity)";

			$parameters ["Street"] = $address->getStreet();
			$parameters ["NumberStreet"] = $address->getNumberStreet();
			$parameters ["IdCity"] = $address->getIdCity();
			
			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters);
			
			$query = "SELECT IdAddress FROM addresses WHERE Street = '" . $address->getStreet() . "' AND NumberStreet = '" . $address->getNumberStreet() . "'"; 
			
			$this->connection = Connection::GetInstance();
			$result =$this->connection->Execute($query);

			foreach ($result as $row)
			{
				$cinema->setIdAddress($row['IdAddress']);
			}

	
			$query = "INSERT INTO ".$this->tableName." (CinemaName, IdAddress) VALUES (:CinemaName, :IdAddress)" ;																

			$parameters2["CinemaName"] = $cinema->getCinemaName();
			$parameters2["IdAddress"] = $cinema->getIdAddress();

			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters2);

			return true;
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	

	function Remove($cinema)
	{
		try {
			$query = "DELETE FROM " . $this->tableName . " WHERE IdCinema = " . $cinema->getIdCinema() . ";";

			$parameters["IdCinema"] = $cinema->getIdCinema();

			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query);
		} catch (Exception $ex) {
			return null;
		}
	}

	public function GetAll()
	{
		try {
			$cinemaList = array();
			$query = "SELECT * FROM " . $this->tableName;
			$this->connection = Connection::GetInstance();
			$result = $this->connection->Execute($query);

			foreach ($result as $row) {

				$cinema = new Cinema();
				$cinema->setIdCinema($row["IdCinema"]);
				$cinema->setCinemaName($row["CinemaName"]);
				$cinema->setIdAddress($row["IdAddress"]);
				array_push($cinemaList, $cinema);
			}
			return $cinemaList;

		} catch (Exception $ex) {
			return null;
		}
	}

	public function GetAddress($addressList, $id)
	{
		try {


            $i = 0;
            $address = $addressList[$i];
            while (($i < sizeof($addressList)-1) && ($address->getIdAddress() != $id)) {
                $i++;
                $address = $addressList[$i];
            }
           
            if ($address->getIdAddress() == $id) {
                return $address;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
	}
	public function GetRooms($roomList,$id)
	{
		try {


            $i = 0;
            $rooms= array();
			$room = $roomList[$i];
			
            while (($i < sizeof($roomList)-1) && ($room->getIdRoom() != $id)) {
                $i++;
                $room = $roomList[$i];
            }
           
            if ($room->getIdRoom() == $id) {
                array_push($rooms,$room);
            }
            return $rooms;

        } catch (Exception $ex) {
            throw $ex;
        }
	}

	public function GetCinemaById($idCinema)
	{

		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE idCinema = " . $idCinema. ";";
		
		
			$this->connection = Connection::GetInstance();
			$result = $this->connection->Execute($query);

			foreach ($result as $row) {
				$cinema = new Cinema();
				$cinema->setIdCinema($row["IdCinema"]);
				$cinema->setCinemaName($row["CinemaName"]);
				$cinema->setIdAddress($row["IdAddress"]);
				return $cinema;
			}
		} catch (Exception $ex) {
			return null;
		}
	}

	public function UpdateCinema($idCinema, $cinemaName, $address)
	{
		try {
			$query = "INSERT INTO addresses (Street, NumberStreet, IdCity ) VALUES (:Street, :NumberStreet, :IdCity)";

			$parameters ["Street"] = $address->getStreet();
			$parameters ["NumberStreet"] = $address->getNumberStreet();
			$parameters ["IdCity"] = $address->getIdCity();
			
			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters);
			
			$query = "SELECT IdAddress FROM addresses WHERE Street = '" . $address->getStreet() . "' AND NumberStreet = '" . $address->getNumberStreet() . "'"; 
			
			$this->connection = Connection::GetInstance();
			$result =$this->connection->Execute($query);

			foreach ($result as $row)
			{
				$address->setIdAddress($row['IdAddress']);
			}


			$query = "UPDATE " . $this->tableName . " SET IdCinema = :IdCinema, CinemaName = :CinemaName, IdAddress = :IdAddress WHERE IdCinema =" . $idCinema . ";";

			$parameters2["IdCinema"] = $idCinema;
			$parameters2["CinemaName"] =$cinemaName;
			$parameters2["IdAddress"] = $address->getIdAddress();

			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters2);
			return true;
		} catch (Exception $ex) {
			return null;
		}
	}
	public function getCinemaByName($cinema)
	{
		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE CinemaName = '" . $cinema . "';";

			$this->connection = Connection::GetInstance();

			$result = $this->connection->Execute($query);

			foreach ($result as $row) {
				$cinema = new Cinema();
				$cinema->setIdCinema($row["IdCinema"]);
				$cinema->setCinemaName($row["CinemaName"]);
				$cinema->setIdAddress($row["IdAddress"]);
				return $cinema;
			}
		} catch (Exception $ex) {
			return null;
		}
	}

	public function getCinemasByMovie($movieId)
    {

		$cinemaList = array();
		$invokeStoredProcedure = 'CALL GetCinemasByMovie(?)';
		$parameters ["idMovie"] = $movieId;
		$this->connection = Connection::GetInstance();
		return $this->connection->Execute($invokeStoredProcedure,$parameters, QueryType::StoredProcedure);

    }
}
