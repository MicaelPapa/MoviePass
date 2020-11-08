<?php
namespace DAO;

use Models\Movies as Movies;
use Models\Cinema as Cinema;
use Models\Screening as Screening;
use Interfaces\IScreeningDAO as IScreeningDAO;

    class ScreeningDAO implements IScreeningDAO{

        private $connection;
        private $tableName = "Screenings";
        private $movieTableName = "Movies";
        private $cinemaTableName = "Cinemas";
        private $roomTableName = "Rooms";

        public function add($screening){

            try{
                $query = "INSERT INTO " . $this->tableName . " (IdMovie, IdMovieIMDB, StartDate, LastDate, IdRoom, 
                IdCinema, Dimension, Audio, Subtitles, StartHour, FinishHour, Price)
                VALUES (:IdMovie, :IdMovieIMDB, :StartDate, :LastDate, :IdRoom, 
                :IdCinema, :Dimension, :Audio, :Subtitles, :StartHour, :FinishHour, :Price);";


                $parameters["IdMovie"] = $screening->getIdMovie();
                $parameters["IdMovieIMDB"] = $screening->getIdMovieIMDB();
                $parameters["StartDate"] = $screening->getStartDate();
                $parameters["LastDate"] = $screening->getLastDate();
                $parameters["IdRoom"] = $screening->getIdRoom();
                $parameters["IdCinema"] = $screening->getIdCinema();
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

		        } 
		    catch (Exception $ex){
			    throw $ex;
		        }
        }

    public function GetAll(){
        try{
            $list = array();
            $query = "SELECT * FROM " .$this->tableName;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) 
                {
                    $screening = new Screening();
                    $screening->setIdScreening($row["IdScreening"]);
		    $screening->setIdMovie($row["IdMovie"]);
                    $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                    $screening->setStartDate($row["StartDate"]);
                    $screening->setLastDate($row["LastDate"]);
                    $screening->setIdRoom($row["IdRoom"]);
                    $screening->setIdCinema($row["IdCinema"]);
                    $screening->setDimension($row["Dimension"]);
                    $screening->setAudio($row["Audio"]);
                    $screening->setPrice($row["Price"]);
                    $screening->setSubtitles($row["Subtitles"]);
                    $screening->setStartHour($row["StartHour"]);
                    $screening->setFinishHour($row["FinishHour"]);
                    $screening->setRemainTickets($row["RemainTickets"]);

                    array_push($list,$screening);
                }	
                return $list;
            
		} 
	catch (Exception $ex) 
	{
		return null;
	}

    }

    public function GetScreeningById($idScreening){
        try{
            $list = array();
            $query = "SELECT * FROM " .$this->tableName ." WHERE IdScreening = ". $idScreening;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
    
                    
            foreach ($resultSet as $row) {
                    
                $screening = new Screening();
                $screening->setIdScreening($row["IdScreening"]);
		        $screening->setIdMovie($row["IdMovie"]);
                $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                $screening->setStartDate($row["StartDate"]);
                $screening->setLastDate($row["LastDate"]);
                $screening->setIdRoom($row["IdRoom"]);
                $screening->setIdCinema($row["IdCinema"]);
                $screening->setDimension($row["Dimension"]);
                $screening->setAudio($row["Audio"]);
                $screening->setPrice($row["Price"]);
                $screening->setSubtitles($row["Subtitles"]);
                $screening->setStartHour($row["StartHour"]);
                $screening->setFinishHour($row["FinishHour"]);
                $screening->setRemainTickets($row["RemainTickets"]);
                return $screening;
                }
            }
            catch(Exception $ex)
            {
                return null;
            }
    
        }
    function remove($screening)
        {
            try{
                $query = "DELETE FROM " . $this->tableName . " WHERE IdScreening = :IdScreening;";
                    
                $parameters['IdScreening'] = $screening->getIdScreening();
                    
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex){
                
                return null;
            }
        }
        
    public function edit($screening){

        try{
            $query = "UPDATE ". $this->tableName ." SET IdMovieIMDB = :IdMovieIMDB, StartDate = :StartDate, 
            LastDate = :LastDate, IdRoom = :IdRoom, IdCinema = :IdCinema, Dimension = :Dimension,

            Audio = :Audio, Subtitles = :Subtitles, StartHour = :StartHour, FinishHour = :FinishHour, Price = :Price,
            RemainTickets = :RemainTickets WHERE IdScreening = " . $screening->getId() . " ;";
                       
            $parameters["StartDate"] = $screening->getStartDate();
            $parameters["LastDate"] = $screening->getLastDate();
            $parameters["IdRoom"] = $screening->getIdRoom();
            $parameters["IdCinema"] = $screening->getIdCinema();
            $parameters["Dimension"] = $screening->getDimension();
            $parameters["Audio"] = $screening->getAudio();
            $parameters["Price"] = $screening->getPrice();
            $parameters["Subtitles"] = $screening->getSubtitles();
            $parameters["StartHour"] = $screening->getStartHour();
            $parameters["FinishHour"] = $screening->getFinishHour();
            $parameters["RemainTickets"] = $screening->getRemainTickets();

                    
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            } 
        catch (Exception $ex){
            throw $ex;
        }
    }
    public function GetScreeningByIdMovie($movie){
        try{
            $list = array();
            $query = "SELECT * FROM " . $this->tableName ." as s INNER JOIN movieXcinema as mc ON s.idMovie = mc.idMovie  WHERE s.IdMovieIMDB = ". $movie->getIdMovieIMDB() . " ;";//--------------------------------//
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            if($resultSet == null){
                $screening = new Screening();
                $screening->setIdScreening("-");
		     //   $screening->setIdMovie($movie->getIdMovie());
                $screening->setIdMovieIMDB($movie->getIdMovieIMDB());
                $screening->setStartDate("-");
                $screening->setLastDate("-");
              //  $screening->setIdRoom("-");
              //  $screening->setIdCinema("-");
                $screening->setDimension("-");
                $screening->setPrice("-");
                $screening->setAudio($movie->getOriginalLanguage());
                $screening->setSubtitles("-");
                $screening->setStartHour("-");
                $screening->setFinishHour("-");
                $screening->setMovie($movie);
                $screening->setCinema("-");
                $screening->setRoom("-");
                array_push($list, $screening);
            }

            else{
                $resultSet = $this->connection->Execute($query);
          
                    foreach ($resultSet as $row){
                  
                        $screening = new Screening();
                        $screening->setIdScreening($row["IdScreening"]);
			          //  $screening->setIdMovie($row["IdMovie"]);
                        $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                        $screening->setStartDate($row["StartDate"]);
                        $screening->setLastDate($row["LastDate"]);
                        $screening->setIdRoom($row["IdRoom"]);
                        $screening->setIdCinema($row["IdCinema"]);
                        $screening->setDimension($row["Dimension"]);
                        $screening->setAudio($row["Audio"]);
                        $screening->setPrice($row["Price"]);
                        $screening->setSubtitles($row["Subtitles"]);
                        $screening->setStartHour($row["StartHour"]);
                        $screening->setFinishHour($row["FinishHour"]);
                        $screening->setRemainTickets($row["RemainTickets"]);
                        $screening->setMovie($movie);
                        array_push($list, $screening);
                    }
            }
            return $list;
        }  
        catch(Exception $ex){
            return null;
        }

    }

        public function GetScreeningByIdCinema($idCinema){
            try{
                $list = array();
                $query = "SELECT * FROM" .$this->tableName ."WHERE IdCinema =". $idCinema;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                
            foreach ($resultSet as $row) 
            {
                $screening = new Screening();
                $screening->setIdScreening($row["IdScreening"]);
		$screening->setIdMovie($row["IdMovie"]);
                $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                $screening->setMovieName($row["MovieName"]);
                $screening->setDuration($row["Duration"]);
                $screening->setSynopsis($row["Synopsis"]);
                $screening->setReleaseDate($row["ReleaseDate"]);
                $screening->setPhoto($row["Photo"]);
                $screening->setEarnings($row["Earnings"]);
                $screening->setBudget($row["Budget"]);
                $screening->setRemainTickets($row["RemainTickets"]);
                return $screening;
            }
            return null;
        }
        catch(Exception $ex)
        {
            return null;
        }

        }
        public function existInDataBase($idMovieIMDB){
            try{
                $list = array();
                $query = "SELECT * FROM " . $this->tableName ." WHERE IdMovieIMDB = ". $idMovieIMDB;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                if($resultSet != null){
                    return true;
                }
                else{
                    return false;
                }
            }
            catch(Exception $ex)
            {
                return null;
            }
        }

        //public function existFunction($idCinema,$idRoom,$startDate)

        public function distinctScreeningPerDay($screening){

            $screeningList = array();
            $date = $screening->getStartDate();
            array_push($screeningList, $screening);

            while($screening->getLastDate()> $date){
                $newScreening = new Screening();
                $date = date("Y-m-d",strtotime($date ."+ 1 days"));

                $newScreening->setIdScreening($screening->getIdScreening());
		        $newScreening->setIdMovie($screening->getIdMovie());
                $newScreening->setIdMovieIMDB($screening->getIdMovieIMDB());
                $newScreening->setStartDate($date);
                $newScreening->setLastDate($screening->getLastDate());
                $newScreening->setIdRoom($screening->getIdRoom());
                $newScreening->setIdCinema($screening->getIdCinema());
                $newScreening->setDimension($screening->getDimension());
                $newScreening->setAudio($screening->getAudio());
                $newScreening->setPrice($screening->getPrice());
                $newScreening->setSubtitles($screening->getSubtitles());
                $newScreening->setStartHour($screening->getStartHour());
                $newScreening->setFinishHour($screening->getFinishHour());
                $screening->setRemainTickets($row["RemainTickets"]);
                array_push($screeningList, $newScreening);
            }


            return $screeningList;
        }

    public function GetScreeningByIdRoom($IdRoom){
        try{
            $list = array();
            $query = "SELECT * FROM " .$this->tableName ." WHERE IdRoom = ". $IdRoom;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
    
                    
            foreach ($resultSet as $row) {
                    
                $screening = new Screening();
                $screening->setIdScreening($row["IdScreening"]);
		        $screening->setIdMovie($row["IdMovie"]);
                $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                $screening->setStartDate($row["StartDate"]);
                $screening->setLastDate($row["LastDate"]);
                $screening->setIdRoom($row["IdRoom"]);
                $screening->setIdCinema($row["IdCinema"]);
                $screening->setDimension($row["Dimension"]);
                $screening->setAudio($row["Audio"]);
                $screening->setPrice($row["Price"]);
                $screening->setSubtitles($row["Subtitles"]);
                $screening->setStartHour($row["StartHour"]);
                $screening->setFinishHour($row["FinishHour"]);
                $screening->setRemainTickets($row["RemainTickets"]);
                return $screening;
                }
            }
            catch(Exception $ex)
            {
                return null;
            }
    
        }
        public function GetScreeningByStartDate($startDate){
        try{
            $list = array();
            $query = "SELECT * FROM " .$this->tableName ." WHERE StartDate = ". $startDate;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
                 
            foreach ($resultSet as $row) {
                        
                $screening = new Screening();
                $screening->setIdScreening($row["IdScreening"]);
		        $screening->setIdMovie($row["IdMovie"]);
                $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                $screening->setStartDate($row["StartDate"]);
                $screening->setLastDate($row["LastDate"]);
                $screening->setIdRoom($row["IdRoom"]);
                $screening->setIdCinema($row["IdCinema"]);
                $screening->setDimension($row["Dimension"]);
                $screening->setAudio($row["Audio"]);
                $screening->setPrice($row["Price"]);
                $screening->setSubtitles($row["Subtitles"]);
                $screening->setStartHour($row["StartHour"]);
                $screening->setFinishHour($row["FinishHour"]);
                $screening->setRemainTickets($row["RemainTickets"]);
                return $screening;
                }
            }
            catch(Exception $ex)
            {
                return null;
            }

        }
    public function validateScreening($screening){
        $screeningList = array();
        $screeningList = $this->GetScreeningByIdRoom($screening->getIdRoom());
        $exist = true;
        if($screeningList != null){
            foreach($screeningList as $value){
                if($value->getStartDate()==$screening->getStartDate()){
                    if($value->getStartHour()==$screening->getStartHour()){
                        $exist=false;
                    }
                }
            }
        }     
        return $exist;
    }

    public function GetScreeningsByMovieAndCinema($MovieId, $CinemaId)
    {
		$invokeStoredProcedure = 'CALL GetScreeningsByMovieAndCinema(?,?)';
        $parameters ["idMovie"] = $MovieId;
        $parameters ["idCinema"] = $CinemaId;
        
		$this->connection = Connection::GetInstance();
		return $this->connection->Execute($invokeStoredProcedure,$parameters, QueryType::StoredProcedure);
    }

    public function getIdAllIdMoviesByDateAndCinema($Date, $CinemaId){
        
        try{
            $query = "SELECT IdMovieIMDB FROM " .$this->tableName ." WHERE StartDate = '". $Date ."' AND IdCinema = '". $CinemaId . "' ;";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
        }
        catch(Exception $ex)
        {
            return null;
        }
        return $resultSet;
    }
    public function getIdAllIdMoviesByDate($Date){
        
        try{
            $query = "SELECT IdMovieIMDB FROM " .$this->tableName ." WHERE StartDate = '". $Date . "' ;";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
        }
        catch(Exception $ex)
        {
            return null;
        }
        return $resultSet;
    }

    public function GetSpecificScreeningByIdMovie($IdMovie){
        try{
            $list = array();
            $query = "SELECT * FROM " .$this->tableName ." WHERE IdMovie = ". $IdMovie;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            $screeningList = array();
    
                    
            foreach ($resultSet as $row) {
                    
                $screening = new Screening();
                $screening->setIdScreening($row["IdScreening"]);
		        $screening->setIdMovie($row["IdMovie"]);
                $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                $screening->setStartDate($row["StartDate"]);
                $screening->setLastDate($row["LastDate"]);
                $screening->setIdRoom($row["IdRoom"]);
                $screening->setIdCinema($row["IdCinema"]);
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
