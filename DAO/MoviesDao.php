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
	private $moviexcinemaTableName = "moviexcinema";
	private $movieGenreTableName = "MoviesXGenres";
	private $screeningTableName = "screenings";


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
				$movies->setIsPlaying($row["IsPlaying"]);

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

	public function Add($movie, $cinema)
	{
		try {
			$idCinema = $cinema->getIdCinema();
			$query = "INSERT INTO " . $this->tableName . " (IdMovieIMDB, MovieName, ReleaseDate, Photo,
			Duration,Synopsis,Earnings,Budget,OriginalLanguage,IsPlaying)
			 VALUES (:IdMovieIMDB, :MovieName, :ReleaseDate, :Photo, :Duration, :Synopsis, :Earnings,
			:Budget, :OriginalLanguage, :IsPlaying);";

			$parameters["IdMovieIMDB"] = $movie->getIdMovieIMDB();
			$parameters["MovieName"] = $movie->getMovieName();
			$parameters["Duration"] = $movie->getDuration();
			$parameters["Synopsis"] = $movie->getSynopsis();
			$parameters["ReleaseDate"] = $movie->getReleaseDate();
			$parameters["Photo"] = $movie->getPhoto();
			$parameters["Earnings"] = $movie->getEarnings();
			$parameters["Budget"] = $movie->getBudget();
			$parameters["OriginalLanguage"] = $movie->getOriginalLanguage();
			$parameters["IsPlaying"] = true;
			
			$query2 = "INSERT INTO movieXcinema (idMovie, idCinema) VALUES( (SELECT idMovie FROM ". $this->tableName . " WHERE IdMovieIMDB = ". $movie->getIdMovieIMDB() ." ), :idCinema );";
			
			$parameters2 ["idCinema"] = $idCinema;

			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters);
			$this->connection->ExecuteNonQuery($query2, $parameters2);
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function setMovieXcinema($cinema, $movie)
	{
		$idMovie = $movie->getIdMovie();
		$idCinema = $cinema->getIdCinema();

		$query = "INSERT INTO movieXcinema (idMovie, idCinema) VALUES( :idMovie, :idCinema );";
		$parameters ["idMovie"] = $idMovie;	
		$parameters ["idCinema"] = $idCinema;
		

		$this->connection = Connection::GetInstance();
		$this->connection->ExecuteNonQuery($query, $parameters);
	}

	public function isExistMovieXCinema ($cinema, $movie)
	{
		$idMovie = $movie->getIdMovie();
		$idCinema = $cinema->getIdCinema();
		$query = "SELECT * FROM movieXcinema WHERE idMovie = ".$idMovie." AND idCinema =" .$idCinema. " ;";

		$this->connection = Connection::GetInstance();
		$result =	$this->connection->Execute($query);

		return $result;


	}
	public function getIsPlayingMovie($movie, $idCinema)
	{
		try {

			/*Le pregunta  a la tabla moviesxcinema  y le trae el idcine y id movie */

		//	$query2 = "SELECT  idMovie FROM movies WHERE idMovieIMDB = ". $movie->getIdMovieIMDB() . " ;";
			$query = "SELECT * FROM  moviexcinema  WHERE IdMovie = ( SELECT  idMovie FROM movies WHERE idMovieIMDB = ". $movie->getIdMovieIMDB() . " ) AND idCinema = " . $idCinema . ";" ;
			$this->connection = Connection::GetInstance();
			$resultSet = $this->connection->Execute($query);

			if ($resultSet != null) {
				return true;
			}
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function AddToDatabase($idMovieIMDB)
	{
		$movies = $this->getMovieDetailsFromApi($idMovieIMDB);
		$this->moviesDAO->add($movies);
		return true;
	}

	function remove($movies, $idCinema)
	{
		try {
			$query = "DELETE FROM " . $this->moviexcinemaTableName . " WHERE IdMovie = " . $movies->getIdMovie() . " AND idCinema = ".$idCinema.";";
			$query2 = "DELETE FROM ". $this->screeningTableName . " WHERE IdMovie = " . $movies->getIdMovie() . " AND idCinema = ". $idCinema. ";" ;
			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query);
			$this->connection->ExecuteNonQuery($query2);
		
			
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function getMovie($movie)
	{
		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE IdMovie = " . $movie->getIdMovie() . ";";
			$this->connection = Connection::GetInstance();
			$resultSet = $this->connection->Execute($query);

			$movie = new Movies  ();
			foreach ($resultSet as $row) {
				$movie->setIdMovie($row["IdMovie"]);
				$movie->setIdMovieIMDB($row["IdMovieIMDB"]);
				$movie->setMovieName($row["MovieName"]);
				$movie->setDuration($row["Duration"]);
				$movie->setSynopsis($row["Synopsis"]);
				$movie->setReleaseDate($row["ReleaseDate"]);
				$movie->setPhoto($row["Photo"]);
				$movie->setEarnings($row["Earnings"]);
				$movie->setBudget($row["Budget"]);
				$movie->setOriginalLAnguage($row["OriginalLanguage"]);
				$movie->setIsPlaying($row["IsPlaying"]);
				return $movie;
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
				$movies->setIsPlaying($row["IsPlaying"]);

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
				$movie = new Movies();
				$movie->setIdMovie($row["IdMovie"]);
				$movie->setIdMovieIMDB($row["IdMovieIMDB"]);
				$movie->setMovieName($row["MovieName"]);
				$movie->setDuration($row["Duration"]);
				$movie->setSynopsis($row["Synopsis"]);
				$movie->setReleaseDate($row["ReleaseDate"]);
				$movie->setPhoto($row["Photo"]);
				$movie->setEarnings($row["Earnings"]);
				$movie->setBudget($row["Budget"]);
				$movie->setOriginalLAnguage($row["OriginalLanguage"]);
				$movie->setIsPlaying($row["IsPlaying"]);
				return $movie;
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
				$movies->setIsPlaying($row["IsPlaying"]);

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
			$movies->setIsPlaying($row["IsPlaying"]);


			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters);
		} catch (Exception $ex) {
			throw $ex;
		}
	}
	public function getByCinema($idCinema)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " m JOIN " . $this->moviexcinemaTableName . " mxc ON (mxc.idMovie = m.IdMovie) WHERE mxc.idCinema= " . $idCinema . ";";
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
                $movies->setIsPlaying($row["IsPlaying"]);

                array_push($list, $movies);
            }
            return $list;
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
