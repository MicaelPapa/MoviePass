<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\Cinema as Cinema;
use Models\Room as Room;
use Models\Address as Address;
use Interfaces\ICinemaDAO as ICinemaDAO;

class cinemaDAO implements ICinemaDAO
{
	private $connection;
	private $tableName = "cinemas";

	public function Add($cinema, $address)
	{
		try {
			
			$query = "INSERT INTO addresses (Street, NumberStreet) VALUES (:Street, :NumberStreet)";

			$parameters ["Street"] = $address->getStreet();
			$parameters ["NumberStreet"] = $address->getNumberStreet();
			
			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters);
			
			$query = "SELECT IdAddress FROM addresses WHERE Street = '" . $address->getStreet() . "' AND NumberStreet = '" . $address->getNumberStreet() . "'"; 
			
			$this->connection = Connection::GetInstance();
			$result =$this->connection->Execute($query);

	/*
				foreach ($result as $row)
			{
				$cinema->setIdAddress($row['IdAddress']);
			}*/
			foreach($result as $row)
			{
				$idAddress = $row['IdAddress'];
			}
		
	
			$query = "INSERT INTO ".$this->tableName." (CinemaName, IdAddress) VALUES (:CinemaName, :IdAddress)" ;																

			$parameters2["CinemaName"] = $cinema->getCinemaName();
			$parameters2["IdAddress"] = $idAddress; //<---------------------------------

			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters2);

			return $idAddress;
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
			
			$query = "SELECT * FROM " . $this->tableName. " as c INNER JOIN addresses a ON c.IdAddress= a.IdAddress ;" ;
			$this->connection = Connection::GetInstance();
			$result = $this->connection->Execute($query);

			foreach ($result as $row) {

				$cinema = new Cinema();
				$cinema->setIdCinema($row["IdCinema"]);
				$cinema->setCinemaName($row["CinemaName"]);


				$address = new Address();
				$address->setIdAddress($row["IdAddress"]);
				$address->setNumberStreet($row["NumberStreet"]);
				$address->setStreet($row["Street"]);

				$cinema->setAddress($address);
			
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
				return $cinema;
			}
		} catch (Exception $ex) {
			return null;
		}
	}

	public function UpdateCinema($idCinema, $cinemaName, $address)
	{
		try {
			
			$query = "UPDATE " . $this->tableName . " SET CinemaName = :CinemaName, IdAddress = :IdAddress WHERE IdCinema =" . $idCinema . ";";

			
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
			//	$address = $this->addressDat
		//		$cinema->setIdAddress($row["IdAddress"]);
				return $cinema;
			}
		} catch (Exception $ex) {
			return null;
		}
	}

	public function getCinemaAddress($idCinema)
	{
		$query = "SELECT * FROM "  . $this->tableName. " WHERE idCinema = '" . $idCinema . "';"; 
		$this->connection = Connection::GetInstance();

		$result = $this->connection->Execute($query);
		
		foreach($result as $row)
		{
			$idAddress = null ;
			$idAddress = $row["IdAddress"];
			return $idAddress;
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

	public function existMoviesInCinema($idCinema)
    {

        $query = "SELECT * FROM movieXcinema WHERE idCinema =" .$idCinema. " ;";

        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query);

        return $result;
    }
}
