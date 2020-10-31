<?php

namespace DAO;

use \Exception as Exception;
use Models\MovieGenre as MovieGenre;
use DAO\Connection as Connection;
use Interfaces\IMovieGenreDAO as IMovieGenreDAO;

class MovieXMovieGenresDAO
{
    private $connection;
    private $tableName = "moviesxmoviesgenres";

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

    public function add($IdGenreIMDB, $IdMovieIMDB)
    {
        try{
            $query = "INSERT INTO " . $this->tableName . " ( IdMovieIMDB, IdGenreIMDB) VALUES (:IdMovieIMDB, :IdGenreIMDB);";
            
            $parameters["IdMovieIMDB"] = $IdMovieIMDB;
            $parameters["IdGenreIMDB"] = $IdGenreIMDB;
            
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
           } catch (Exception $ex) {
            throw $ex;
        }
    }

    function remove($IdMovieGenre)
    {
        try {
            $query = "DELETE FROM " . $this->tableName . " WHERE IdMovieGenre = " . $IdMovieGenre . ";";

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getIdMovie($IdGenreIMDB)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE IdGenreIMDB = " . $IdGenreIMDB . ";";
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
            $query = "SELECT * FROM " . $this->tableName . "WHERE IdGenre = " . $IdGenre . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            return $resultSet;
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