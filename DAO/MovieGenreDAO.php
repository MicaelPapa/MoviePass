<?php

namespace DAO;

use \Exception as Exception;
use Models\MovieGenre as MovieGenre;
use DAO\Connection as Connection;
use Interfaces\IMovieGenreDAO as IMovieGenreDAO;

class MovieGenreDAO implements IMovieGenreDAO
{
    private $connection;
    private $tableName = "MovieGenres";
    private $tableMxGname = "moviesxmoviesgenres";

    public function getAll()
    {
        try {
            $list = array();
            $query = "SELECT * FROM " . $this->tableName . " ORDER BY Name;";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $movieGenre = new MovieGenre();
                $movieGenre->setId($row["IdMovieGenre"]);
                $movieGenre->setIdIMDB($row["IdIMDB"]);
                $movieGenre->setName($row["Name"]);
                array_push($list, $movieGenre);
            }

            return $list;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function add($movieGenre)
    {
        try{
           if(!$this->isIdIMDB($movieGenre->getIdIMDB())){
            
            $query = "INSERT INTO " . $this->tableName . " (IdIMDB, Name) VALUES (:IdIMDB, :Name);";
            
            $parameters["IdIMDB"] = $movieGenre->getIdIMDB();
            $parameters["Name"] = $movieGenre->getName();
            
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
           } 
 
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function remove($movieGenre)
    {
        try {
            $query = "DELETE FROM " . $this->tableName . " WHERE IdMovieGenre = " . $movieGenre->getId() . ";";

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getMovieGenre($movieGenre)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . "WHERE IdMovieGenreIMDB = " . $movieGenre->getIdMovieGenreIMDB() . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $movieGenre->setId($row["IdMovieGenre"]);
                $movieGenre->setId($row["IdMovieGenreIMDB"]);
                $movieGenre->setName($row["Name"]);
            }
            return $movieGenre->getName();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function isIdIMDB($idIMDB){ /*CORREGIR*/
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE IdIMDB = " . $idIMDB . " ;";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            if($resultSet == null){
                return false;
            }
        
            else{
                return true;
            }
        
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public function getGenreById($IdIMDB){
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE IdIMDB = " . $IdIMDB . " ;";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $movieGenre = new MovieGenre();
                $movieGenre->setId($row["IdMovieGenre"]);
                $movieGenre->setIdIMDB($row["IdIMDB"]);
                $movieGenre->setName($row["Name"]);
                return $movieGenre;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function getAllMoviexGenres()
    {
        try {
            $list = array();
            $query = "SELECT * FROM " . $this->tableMxGname . " ORDER BY Name;";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $movieGenre = new MovieGenre();
                $movieGenre->setId($row["IdMovieGenre"]);
                $movieGenre->setIdIMDB($row["IdIMDB"]);
                $movieGenre->setName($row["Name"]);
                array_push($list, $movieGenre);
            }

            return $list;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function addMoviexGenres($IdGenreIMDB, $IdMovieIMDB)
    {
        try{
            $query = "INSERT INTO " . $this->tableMxGname . " ( IdMovieIMDB, IdGenreIMDB) VALUES (:IdMovieIMDB, :IdGenreIMDB);";
            
            $parameters["IdMovieIMDB"] = $IdMovieIMDB;
            $parameters["IdGenreIMDB"] = $IdGenreIMDB;
            
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
           } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function removeMoviexGenres($IdMovieGenre)
    {
        try {
            $query = "DELETE FROM " . $this->tableMxGname . " WHERE IdMovieGenre = " . $IdMovieGenre . ";";

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getIdMovie($IdGenreIMDB)
    {
        try {
            $query = "SELECT * FROM " . $this->tableMxGname . " WHERE IdGenreIMDB = " . $IdGenreIMDB . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            return $resultSet;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getIdGenre($IdGenre)
    {
        try {
            $query = "SELECT * FROM " . $this->tableMxGname . "WHERE IdGenre = " . $IdGenre . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            return $resultSet;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function isIdIMDBmXg($idIMDB){ /*CORREGIR*/
        try {
            $query = "SELECT * FROM " . $this->tableMxGname . "WHERE IdMovieGenreIMDB = " . $movieGenre->getIdMovieGenreIMDB() . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            if($resultSet == null){
                return false;
            }
        
            else{
                return true;
            }
        
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getGenresId(){
        try {
            $query = "SELECT * FROM " . $this->tableMxGname . " group by IdGenreIMDB ;";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            return $resultSet;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}

?>