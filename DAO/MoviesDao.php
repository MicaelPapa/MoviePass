<?php

namespace DAO;

use \Exception as Exception;
use Models\Movies as Movies;
use DAO\Connection as Connection;
use DAO\MovieGenreDAO as MovieGenreDAO;
use Models\MovieGenre as MovieGenre;
use Interfaces\IMoviesDAO as IMoviesDAO;

class MoviesDAO implements IMoviesDAO
{
	private $connection;
	private $tableName = "Movies";
	private $movieGenreTableName = "MoviesXGenres";

	public function GetMoviesByCity($CityId)
	{
		$invokeStoredProcedure = 'CALL GetMoviesByCity(?)';
		$parameters["CityId"] = $CityId;

		$this->connection = Connection::GetInstance();
		return $this->connection->Execute($invokeStoredProcedure, $parameters, QueryType::StoredProcedure);
	}

	public function getAll()
	{
		try {
			$list = array();
			$query = "SELECT * FROM " . $this->tableName;
			$this->connection = Connection::GetInstance();
			$resultSet = $this->connection->Execute($query);

			foreach ($resultSet as $row) {
				$movies = new Movies();
				$movies->setIdMovie($row["IdMovie"]);
				$movies->setIdMovieIMDB($row["IdMovieIMDB"]);
				$movies->setMovieName($row["MovieName"]);
				$movies->setDuration($row["Duration"]);
				$movies->setSynopsis($row["Synopsis"]);
				$movies->setReleaseDate($row["ReleaseDate"]);
				$movies->setPhoto($row["Photo"]);
				$movies->setEarnings($row["Earnings"]);
				$movies->setBudget($row["Budget"]);
				$movies->setOriginalLAnguage($row["OriginalLanguage"]);

				array_push($list, $movies);
			}
			return $list;
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function getAllMoviesResult()
	{
		$query = "SELECT * FROM " . $this->tableName;
		$this->connection = Connection::GetInstance();
		return $this->connection->Execute($query);
	}

	public function add($movies)
	{
		try {
			$query = "INSERT INTO " . $this->tableName . " (IdMovieIMDB, MovieName, ReleaseDate, Photo,
			Duration,Synopsis,Earnings,Budget,OriginalLanguage,IsPlaying)
			 VALUES (:IdMovieIMDB, :MovieName, :ReleaseDate, :Photo, :Duration, :Synopsis, :Earnings,
			:Budget, :OriginalLanguage, :IsPlaying);";

			$parameters["IdMovieIMDB"] = $movies->getIdMovieIMDB();
			$parameters["MovieName"] = $movies->getMovieName();
			$parameters["Duration"] = $movies->getDuration();
			$parameters["Synopsis"] = $movies->getSynopsis();
			$parameters["ReleaseDate"] = $movies->getReleaseDate();
			$parameters["Photo"] = $movies->getPhoto();
			$parameters["Earnings"] = $movies->getEarnings();
			$parameters["Budget"] = $movies->getBudget();
			$parameters["OriginalLanguage"] = $movies->getOriginalLanguage();
			$parameters["IsPlaying"] = true;

			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters);
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function AddToDatabase($idMovieIMDB)
	{
		$movies = $this->getMovieDetailsFromApi($idTMDB);
		$this->moviesDAO->add($movies);
		return true;
	}

	function remove($movies)
	{
		try {
			$query = "DELETE FROM " . $this->tableName . " WHERE IdMovieIMDB = " . $movies->getIdMovieIMDB() . ";";

			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query);
			/* 
			$query = "DELETE FROM " . $this->generoTableName . " WHERE IdMovieIMDB = " . $movies->getIdMovieIMDB) . ";";

			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query); */
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function getMovies($movies)
	{
		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE IdMovie = " . $movies->getIdMovie() . ";";
			$this->connection = Connection::GetInstance();
			$resultSet = $this->connection->Execute($query);

			foreach ($resultSet as $row) {
				$movies->setIdMovie($row["IdMovies"]);
				$movies->setIdMovieIMDB($row["IdMovieIMDB"]);
				$movies->setMovieName($row["MovieName"]);
				$movies->setDuration($row["Duration"]);
				$movies->setSynopsis($row["Synopsis"]);
				$movies->setReleaseDate($row["ReleaseDate"]);
				$movies->setPhoto($row["Photo"]);
				$movies->setEarnings($row["Earnings"]);
				$movies->setBudget($row["Budget"]);
				$movies->setOriginalLAnguage($row["OriginalLanguage"]);
				return $movies;
			}
		} catch (Exception $ex) {
			return null;
		}
	}

	/* 	public function getMovieGenders($movies)
	{
		try
		{
			$query = "SELECT * FROM " . $this->generoTableName . " WHERE IdMovie = " . $movies->getIdMovie() . ";";
			$this->connection = Connection::GetInstance();
			$resultSet = $this->connection->Execute($query);

			$generos = array();
			foreach ($resultSet as $row) 
			{
				array_push($genders, $row["IdGender"]);
			}
			return $genders;
		} 
		catch (Exception $ex) 
		{
			return null;
		}
	} */

	/* 	public function saveGeneros($Movies, $generos)
	{
		try
		{
			foreach($generos as $genero)
			{
				$query = "INSERT INTO " . $this->generoTableName . " (IdMovie, id_generoo) VALUES (:id_Moviesa, :id_generoo);";
				$parameters["IdMovie"] = $Movies->getId();
				$parameters["id_generoo"] = $genero;

				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
			}
		} 
		catch (Exception $ex) 
		{
			throw $ex;
		}
	} */

	public function getByMovieId($idMovie)
	{
		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE IdMovie = " . $idMovie . ";";
			$this->connection = Connection::GetInstance();
			$resultSet = $this->connection->Execute($query);

			foreach ($resultSet as $row) {
				$movies->setIdMovie($row["IdMovie"]);
				$movies->setIdMovieIMDB($row["IdMovieIMDB"]);
				$movies->setMovieName($row["MovieName"]);
				$movies->setDuration($row["Duration"]);
				$movies->setSynopsis($row["Synopsis"]);
				$movies->setReleaseDate($row["ReleaseDate"]);
				$movies->setPhoto($row["Photo"]);
				$movies->setEarnings($row["Earnings"]);
				$movies->setBudget($row["Budget"]);
				$movies->setOriginalLAnguage($row["OriginalLanguage"]);

				return $movies;
			}
		} catch (Exception $ex) {
			return null;
		}
	}

	public function getByIdMovieIMDB($idMovieIMDB)
	{
		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE IdMovieIMDB = " . $idMovieIMDB . ";";
			$this->connection = Connection::GetInstance();
			$resultSet = $this->connection->Execute($query);

			foreach ($resultSet as $row) {
				$movies = new Movies();
				$movies->setIdMovie($row["IdMovie"]);
				$movies->setIdMovieIMDB($row["IdMovieIMDB"]);
				$movies->setMovieName($row["MovieName"]);
				$movies->setDuration($row["Duration"]);
				$movies->setSynopsis($row["Synopsis"]);
				$movies->setReleaseDate($row["ReleaseDate"]);
				$movies->setPhoto($row["Photo"]);
				$movies->setEarnings($row["Earnings"]);
				$movies->setBudget($row["Budget"]);
				$movies->setOriginalLAnguage($row["OriginalLanguage"]);
				return $movies;
			}
		} catch (Exception $ex) {
			return null;
		}
	}

	public function getByMovieName($movieName)
	{
		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE MovieName LIKE '%" . $movieName . "%';";
			$this->connection = Connection::GetInstance();
			$resultSet = $this->connection->Execute($query);
			$list = array();

			foreach ($resultSet as $row) {
				$movies = new Movies();
				$movies->setIdMovie($row["IdMovie"]);
				$movies->setIdMovieIMDB($row["IdMovieIMDB"]);
				$movies->setMovieName($row["MovieName"]);
				$movies->setDuration($row["Duration"]);
				$movies->setSynopsis($row["Synopsis"]);
				$movies->setReleaseDate($row["ReleaseDate"]);
				$movies->setPhoto($row["Photo"]);
				$movies->setEarnings($row["Earnings"]);
				$movies->setBudget($row["Budget"]);
				$movies->setOriginalLAnguage($row["OriginalLanguage"]);

				array_push($list, $movies);
			}
			return $list;
		} catch (Exception $ex) {
			return null;
		}
	}

	public function edit($movies)
	{
		try {
			$query = "UPDATE " . $this->tableName . " SET IdMovieIMDB = :IdMovieIMDB, MovieName = :MovieName, Duration = :Duration, Synopsis = :Synopsis, ReleaseDate = :ReleaseDate, Photo = :Photo, Earnings = :Earnings, Budget = :Budget WHERE IdMovie = :IdMovie;";
			$parameters["IdMovieIMDB"] = $movies->getIdMovieIMDB();
			$parameters["MovieName"] = $movies->getMovieName();
			$parameters["Duration"] = $movies->getDuration();
			$parameters["Synopsis"] = $movies->getSynopsis();
			$parameters["ReleaseDate"] = $movies->getReleaseDate();
			$parameters["Photo"] = $movies->getPhoto();
			$parameters["Earnings"] = $movies->getEarnings();
			$parameters["Budget"] = $movies->getBudget();
			$parameters["OriginalLanguage"] = $movies->getOriginalLanguage();


			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters);
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function getIsPlayingMovie($movies)
	{
		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE IdMovieIMDB = " . $movies->getIdMovieIMDB() . ";";
			$this->connection = Connection::GetInstance();
			$resultSet = $this->connection->Execute($query);

			if ($resultSet != null) {
				return true;
			}
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	/* 	public function setMoviesAndGenres($movies,$movieGenre){
		try{
			$query = "INSERTO INTO".$this->movieGenreTableName."(IdMovieIMDB, IdGenreIMDB) VALUES (:IdMovieIMDB, :IdGenreIMDB);";
			$parameters["IdMovieIMDB"] = $movies->getIdMovieIMDB();
			
			foreach ($movieGenre as $values){
				if($movies->getIdMovieIMDB() == $values->getIdIMDB()) $parameters["IdGenreIMDB"] = $values->getIdIMDB();
			}
			
			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters);


		} 
		catch (Exception $ex) 
		{
			throw $ex;
		}
	

	} */
}
