<?php

namespace DAO;

use Models\Movies as Movies;
use Models\Cinema as Cinema;
use Models\Screening as Screening;
use Models\Room as Room;
use Interfaces\IScreeningDAO as IScreeningDAO;

class ScreeningDAO implements IScreeningDAO
{

    private $connection;
    private $tableName = "Screenings";
    private $movieTableName = "Movies";
    private $cinemaTableName = "Cinemas";
    private $roomTableName = "Rooms";

    public function Add($screening, $idCinema)
    {

        try {
            $query = "INSERT INTO " . $this->tableName . " (IdMovie, IdMovieIMDB, StartDate, LastDate, IdRoom, 
                IdCinema, Dimension, Audio, Subtitles, StartHour, FinishHour, Price, RemainTickets)
                VALUES (:IdMovie, :IdMovieIMDB, :StartDate, :LastDate, :IdRoom, 
                :IdCinema, :Dimension, :Audio, :Subtitles, :StartHour, :FinishHour, :Price, :RemainTickets);";


            $parameters["IdMovie"] = $screening->getMovie()->getIdMovie();
            $parameters["IdMovieIMDB"] = $screening->getMovie()->getIdMovieIMDB();
            $parameters["StartDate"] = $screening->getStartDate();
            $parameters["LastDate"] = $screening->getLastDate();
            $parameters["IdRoom"] = $screening->getRoom()->getIdRoom();
            $parameters["IdCinema"] = $screening->getCinema()->GetIdCinema();
            $parameters["Dimension"] = $screening->getDimension();
            $parameters["Audio"] = $screening->getAudio();
            $parameters["Price"] = $screening->getPrice();
            $parameters["Subtitles"] = $screening->getSubtitles();
            $parameters["StartHour"] = $screening->getStartHour();
            $parameters["FinishHour"] = $screening->getFinishHour();
            $parameters["RemainTickets"] = $screening->getRemainTickets();
            
            $this->connection = Connection::GetInstance();
            $result = $this->connection->ExecuteNonQuery($query, $parameters);

            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {
            $list = array();
            $query = "SELECT * FROM " . $this->tableName;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $screening = new Screening();
                $screening->setIdScreening($row["IdScreening"]);
                $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                $screening->setStartDate($row["StartDate"]);
                $screening->setLastDate($row["LastDate"]);
                $screening->setDimension($row["Dimension"]);
                $screening->setAudio($row["Audio"]);
                $screening->setPrice($row["Price"]);
                $screening->setSubtitles($row["Subtitles"]);
                $screening->setStartHour($row["StartHour"]);
                $screening->setFinishHour($row["FinishHour"]);
                $screening->setRemainTickets($row["RemainTickets"]);

                $room = new Room();
                $room->setIdRoom($row["IdRoom"]);
                $screening->setRoom($room);
                $cinema = new Cinema();
                $cinema->setIdCinema($row["IdCinema"]);
                $screening->setCinema($cinema);
                $movie = new Movie();
                $movie->setIdMovie($row["IdMovie"]);
                $movie->setIdMovieIMDB($row["IdMovieIMDB"]);
                $screening->setMovie($movie);

                array_push($list, $screening);
            }
            return $list;
        } catch (Exception $ex) {
            return null;
        }
    }

    public function GetScreeningById($idScreening)
    {
        try {
            $list = array();
            $query = "SELECT * FROM " . $this->tableName . " WHERE IdScreening = " . $idScreening;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);


            foreach ($resultSet as $row) {

                $screening = new Screening();

                $screening->setIdScreening($row["IdScreening"]);
                $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                $screening->setStartDate($row["StartDate"]);
                $screening->setLastDate($row["LastDate"]);
                $screening->setDimension($row["Dimension"]);
                $screening->setAudio($row["Audio"]);
                $screening->setPrice($row["Price"]);
                $screening->setSubtitles($row["Subtitles"]);
                $screening->setStartHour($row["StartHour"]);
                $screening->setFinishHour($row["FinishHour"]);
                $screening->setRemainTickets($row["RemainTickets"]);

                
                $cinema = new Cinema();
                $room = new Room();
                $movie = new Movies();
                $movie->setIdMovie($row["IdMovie"]);
                $movie->setIdMovieIMDB($row["IdMovieIMDB"]);
                $room->setIdRoom($row["IdRoom"]);
                $screening->setRoom($room);
                $cinema->setIdCinema($row["IdCinema"]);
                $screening->setCinema($cinema);
                $screening->setRoom($room);
                $screening->setMovie($movie);

                return $screening;
            }
        } catch (Exception $ex) {
            return null;
        }
    }
    function remove($screening)
    {
        try {
            $query = "DELETE FROM " . $this->tableName . " WHERE IdScreening = :IdScreening;";

            $parameters['IdScreening'] = $screening->getIdScreening();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {

            return null;
        }
    }

    public function GetScreeningsByIdMovie($movie)
    {

        try {
            $list = array();
            $query = "SELECT * FROM " . $this->tableName . " WHERE IdMovieIMDB = " . $movie->getIdMovieIMDB() . " ;"; 
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            if ($resultSet == null) {
                $screening = new Screening();
                $screening->setIdScreening("-");
                $screening->setIdMovieIMDB($movie->getIdMovieIMDB());
                $screening->setStartDate("-");
                $screening->setLastDate("-");
                $screening->setIdRoom("-");
                $screening->setIdCinema("-");
                $screening->setDimension("-");
                $screening->setPrice("-");
                $screening->setAudio($movie->getOriginalLanguage());
                $screening->setSubtitles("-");
                $screening->setStartHour("-");
                $screening->setFinishHour("-");
                $screening->setMovie($movie);
                $screening->setCinema(new Cinema());
                $screening->setRoom(new Room());
                $screening->getCinema()->setIdCinema("-");
                $screening->getRoom()->setRoomNumber("-");
                array_push($list, $screening);
            } else {


                foreach ($resultSet as $row) {

                    $screening = new Screening(); 
                    $cinema = new Cinema();
                    $room = new Room();
                    $screening->setIdScreening($row["IdScreening"]);
                    $screening->setStartDate($row["StartDate"]);
                    $screening->setLastDate($row["LastDate"]);
                    $screening->setDimension($row["Dimension"]);
                    $screening->setAudio($row["Audio"]);
                    $screening->setPrice($row["Price"]);
                    $screening->setSubtitles($row["Subtitles"]);
                    $screening->setStartHour($row["StartHour"]);
                    $screening->setFinishHour($row["FinishHour"]);
                    $screening->setRemainTickets($row["RemainTickets"]);
                    $room->setIdRoom($row["IdRoom"]);
                    $screening->setRoom($room);
                    $cinema->setIdCinema($row["IdCinema"]);
                    $screening->setCinema($cinema);
                    $screening->setMovie($movie);
                    array_push($list, $screening);
                }
            }
            return $list;
        } catch (Exception $ex) {
            return null;
        }
    }

    public function existInDataBase($idMovieIMDB)
    {
        try {
            $list = array();
            $query = "SELECT * FROM " . $this->tableName . " WHERE IdMovieIMDB = " . $idMovieIMDB;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            if ($resultSet != null) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function distinctScreeningPerDay($screening)  //separa  las funciones por dia en un arreglo.
    {

        $screeningList = array();
        $date = $screening->getStartDate();
        array_push($screeningList, $screening);

        while ($screening->getLastDate() > $date) {
            $newScreening = new Screening();
            $date = date("Y-m-d", strtotime($date . "+ 1 days"));

            $newScreening->setIdScreening($screening->getIdScreening());
            $newScreening->setStartDate($date);
            $newScreening->setLastDate($screening->getLastDate());
            $newScreening->setDimension($screening->getDimension());
            $newScreening->setAudio($screening->getAudio());
            $newScreening->setPrice($screening->getPrice());
            $newScreening->setSubtitles($screening->getSubtitles());
            $newScreening->setStartHour($screening->getStartHour());
            $newScreening->setFinishHour($screening->getFinishHour());
            $newScreening->setMovie($screening->getMovie());
            $newScreening->setRoom($screening->getRoom());
            $newScreening->setCinema($screening->getCinema());
            $newScreening->setRemainTickets($screening->getRemainTickets());

            array_push($screeningList, $newScreening);
        }
        return $screeningList;
    }

    public function validateScreening($screening) //Realiza las validaciones pertinentes para poder agregar una función, devuelve un mensaje y un boolean.
    {  
        $notExist = false;
        $alertMessage = ""; 
        $middleTime = strtotime("+15 minutes", strtotime($screening->getFinishHour()));
        $middleTime = date('Y-m-d H:i:s', $middleTime); //setea un entretiempo sumando 15 minutos al horario de finalizacion de la pelicula 
   

        $query  = "select * from " . $this->tableName . "  where  IdMovieIMDB = " . $screening->getMovie()->getIdMovieIMDB() . " and  StartDate = '" . $screening->getStartDate() . "' and IdCinema != " . $screening->getCinema()->getIdCinema() . " ;"; //cine unico en ese dia
        $query2 = "select * from " . $this->tableName . " where IdMovieIMDB = " . $screening->getMovie()->getIdMovieIMDB() . " and IdRoom != " . $screening->getRoom()->getIdRoom() . " AND idCinema = " . $screening->getCinema()->getIdCinema() . " ;"; //sala unica
        $query3 =  "select * from " . $this->tableName . " where  IdMovieIMDB = " . $screening->getMovie()->getIdMovieIMDB() . " and StartDate = '" . $screening->getStartDate() . "' and (( CAST('" . $screening->getStartHour() . "' AS  DATETIME) between StartHour AND finishhour) or (CAST('" . $middleTime . "' AS  DATETIME) between StartHour AND finishhour));"; //Valida que los horarios de la funcion (+15 minutos) no se pisen

        $this->connection = Connection::GetInstance();

        $notUniqueCinema = $this->connection->Execute($query);
        $notUniqueRoom = $this->connection->Execute($query2);
        $notUniqueHour = $this->connection->Execute($query3);
        if (!$notUniqueCinema && !$notUniqueRoom && !$notUniqueHour)
        {
            $notExist = true;
        } else if ($notUniqueCinema) {
            $alertMessage = "No es posible agregar una funcion en este dia debido a que ya existe en otro cine.";
        } else if ($notUniqueRoom) {
            $alertMessage = "Esta pelicula le pertenece a otra Sala. Intente nuevamente";
        } else if ($notUniqueHour) {
            $alertMessage = "Ya existe una funcion para esta pelicula en el horario que queres ingresar.";
        }

        $validate = array();

        array_push($validate, $alertMessage, $notExist);
        return $validate;
    }

    public function getAllIdMoviesByDate($Date)
    {
        try {
            $query = "SELECT IdMovieIMDB FROM " . $this->tableName . " WHERE StartDate = '" . $Date . "' ;";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
        } catch (Exception $ex) {
            return null;
        }
        return $resultSet;
    }

    public function GetSpecificScreeningByMovie($movie){
        try{
            $list = array();
            $query = "SELECT * FROM " .$this->tableName ." WHERE IdMovie = ". $movie->getIdMovie();
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $screeningList = array();
                    
            foreach ($resultSet as $row) {      
                $screening = new Screening();
                $screening->setMovie(new Movies());
                $screening->setCinema(new Cinema());
                $screening->setRoom(new Room());

                $screening->setIdScreening($row["IdScreening"]);
                $screening->getMovie()->setIdMovie($row["IdMovie"]);
                $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                $screening->setStartDate($row["StartDate"]);
                $screening->setLastDate($row["LastDate"]);
                $screening->getRoom()->setIdRoom($row["IdRoom"]);
                $screening->getCinema()->setIdCinema($row["IdCinema"]);
                $screening->setDimension($row["Dimension"]);
                $screening->setAudio($row["Audio"]);
                $screening->setPrice($row["Price"]);
                $screening->setSubtitles($row["Subtitles"]);
                $screening->setStartHour($row["StartHour"]);
                $screening->setFinishHour($row["FinishHour"]);
                $screening->setRemainTickets($row["RemainTickets"]);

                array_push($screeningList, $screening);
                }
            }
            catch(Exception $ex)
            {
                return null;
            }
            return $screeningList;
        }
        public function getCinemaByIdCinema($idCinema){
            try {
                $query = "SELECT * FROM " . $this->cinemaTableName . " WHERE idCinema = " . $idCinema. ";";
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
}
