<?php

namespace DAO;

use Models\Room as Room;
use Models\Cinema as Cinema;
use Interfaces\IRoomDAO as IRoomDAO;

class RoomDAO implements IRoomDAO
{
    private $connection;
    private $tableName = "rooms";

    public function Add($room, $cinema)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (Capacity,RoomNumber,CinemaId) VALUES (:Capacity, :RoomNumber, :CinemaId);";

            $parameters["RoomNumber"] = $room->getRoomNumber();
            $parameters["Capacity"] = $room->getCapacity();
            $parameters["CinemaId"] = $cinema->getIdCinema();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
    function Remove($room)
    {
        try {
            $query = "DELETE FROM " . $this->tableName . " WHERE idRoom = :idRoom;";
            $parameters['idRoom'] = $room->getIdRoom();
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function UpdateRoom ($idRoom, $roomNumber, $capacity)
    {
        try {
			
			$query = "UPDATE " . $this->tableName . " SET RoomNumber = :RoomNumber, Capacity = :Capacity WHERE IdRoom = " . $idRoom . ";";

			
         
            $parameters["RoomNumber"] = $roomNumber;
			$parameters["Capacity"] = $capacity;

			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters);
			return true;
		} catch (Exception $ex) {
			return null;
		}
    }

    public function GetAll()
    {
        try {
            $roomList = array();
            $query = "SELECT * FROM " . $this->tableName . " as r INNER JOIN cinemas as c ON c.IdCinema= r.CinemaId ;";

            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            foreach ($result as $row) {
                $room = new Room();
                $room->setIdRoom($row["IdRoom"]);
                $room->setRoomNumber($row["RoomNumber"]);
                $room->setCapacity($row["Capacity"]);

                $cinema = new Cinema();
                $cinema->setIdCinema($row["IdCinema"]);
                $cinema->setCinemaName($row["CinemaName"]);

                $room->setCinema($cinema);
                array_push($roomList, $room);
            }
            return $roomList;
        } catch (Exception $ex) {
            return null;
        }
    }

    public function GetRoomsByCinema($idCinema)
    {
        try {
            $roomList = array();
            $query = "SELECT * FROM " . $this->tableName . " as r INNER JOIN cinemas as c ON r.CinemaId = c.IdCinema WHERE CinemaId = " . $idCinema . " ;";

            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);
            foreach ($result as $row) {
                $room = new Room();
                $room->setIdRoom($row["IdRoom"]);
                //s $room->setIdCinema($row["CinemaId"]);
                $room->setRoomNumber($row["RoomNumber"]);
                $room->setCapacity($row["Capacity"]);

                $cinema = new Cinema();
                $cinema->setIdCinema($row["IdCinema"]);
                $cinema->setCinemaName($row["CinemaName"]);

                $room->setCinema($cinema);

                array_push($roomList, $room);
            }
            return $roomList;
        } catch (Exception $ex) {
            return null;
        }
    }

    public function GetIdCinema($idRoom)
    {
        $query = "SELECT CinemaId FROM " . $this->tableName . " WHERE IdRoom = " . $idRoom . " ;";
        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query);

        foreach ($result as $row) {
            $idCinema = null;
            $idCinema = $row["CinemaId"];
            return $idCinema;
        }
    }

    public function GetRoomById($idRoom)

    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE idRoom = " . $idRoom . ";";


            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            foreach ($result as $row) {
                $room = new Room();
                $room->setIdRoom($row["IdRoom"]);
                $room->setRoomNumber($row["RoomNumber"]);
                $room->setCapacity($row["Capacity"]);
                return $room;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public
}
