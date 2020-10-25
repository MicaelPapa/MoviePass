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
           if($this->isIdIMDB($movieGenre->getIdIMDB)){
            
            $query = "INSERT INTO " . $this->tableName . " (IdMovieGenre, Name) VALUES (:IdMovieGenre, :Name);";
            
            $parameters["IdMovieGenre"] = $movieGenre->getId();
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
            $query = "SELECT * FROM " . $this->tableName . "WHERE IdMovieGenreIMDB = " . $movieGenre->getIdMovieGenreIMDB() . ";";
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
}

?>