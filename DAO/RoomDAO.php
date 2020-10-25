<?php
    namespace DAO;
    use Models\Room as Room;
    use Interfaces\IRoomDAO as IRoomDAO;
    class RoomDAO implements IRoomDAO
    {
        private $connection;
        private $tableName = "rooms";
       
        public function Add($room, $cinema)
        {
            try 
            {
                $query = "INSERT INTO " . $this->tableName . " (Capacity,RoomNumber,CinemaId) VALUES (:Capacity, :RoomNumber, :CinemaId);";
                
                $parameters["RoomNumber"] = $room->getRoomNumber();
                $parameters["Capacity"] = $room->getCapacity();
                $parameters["CinemaId"] = $cinema->getIdCinema();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                return true;
            } 
            catch (Exception $ex) 
            {
                return false;
            }
        }
        function Remove($room)
        {
            try 
            {
                $query = "DELETE FROM " . $this->tableName . " WHERE idRoom = :idRoom;";
                $parameters['idRoom'] = $room->getIdRoom();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                return true;
            } 
            catch (Exception $ex) 
            {
                return false;
            }
        }


        public function GetAll()
        {
            try {
                $roomList = array();
                $query = "SELECT * FROM " . $this->tableName;

                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
    
                foreach ($result as $row) {
                    $room = new Room();
                    $room->setIdRoom($row["IdRoom"]);
                    $room->setRoomNumber($row["RoomNumber"]);
                    $room->setCapacity($row["Capacity"]);
                    $room->setIdCinema($row["CinemaId"]);

                    array_push($roomList, $room);
                }
                return $roomList;
            } catch (Exception $ex) {
                return null;
            }
        }
        
        public function GetRoomByCinema($idCinema)
        {
            try 
            {
                $roomList = array();
                $query = "SELECT * FROM " . $this->tableName ." WHERE CinemaId = ".$idCinema;

                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                foreach ($result as $row) 
                {
                    $room = new Room();
                    $room->setIdRoom($row["IdRoom"]);
                    $room->setIdCinema($row["CinemaId"]);
                    $room->setRoomNumber($row["RoomNumber"]);
                    $room->setCapacity($row["Capacity"]);

                 

                    array_push($roomList, $room);
                }
                return $roomList;
            }
            catch (Exception $ex) 
            {
                return null;
            }
        }
      
    }
?>