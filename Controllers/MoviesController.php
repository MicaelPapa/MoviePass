<?php

namespace Controllers;

use DAO\MoviesDAO as MoviesDAO;
use DAO\MovieGenreDAO as MovieGenreDAO;
use Models\Movies as Movies;
use API\IMDBController as IMDBController;
use Controllers\ScreeningController as ScreeningController;
use Util\apiResponse as ApiResponse;


class MoviesController
{
	private $moviesDao;

	public function __construct()
	{
		$this->moviesDAO = new MoviesDAO();
		$this->movieGenreDAO = new MovieGenreDAO();
	}

	
	public function AddMovieToDatabase($idCinema, $idMovieIMDB)
	{
		$screeningHelper = new ScreeningController();

		if ($idMovieIMDB == null) {

			$idMovieIMDB = 0;
		
		}

		if ($this->moviesDAO->getByIdMovieIMDB($idMovieIMDB) == NULL) {
			$movie = $this->getInfoMovieApi($idMovieIMDB);
			$this->moviesDAO->Add($movie, $idCinema);
		}

		$screeningHelper->View($movie->getIdMovieIMDB());
	}



	public function ShowApiMovies($idCinema)
	 {/*
		if ($movieList == null) {
			$page = 1;
		} */
		$movieList = $this->getNowPlayingMoviesInfoFromApi($idCinema);
/* 
		while (count($movieList) == 0) {
			$movieList = $this->getNowPlayingMoviesInfoFromApi(++$page);
		} */
		require_once(VIEWS_PATH . "AdminMoviesPlayingView.php");
	}
	public function getNowPlayingMoviesInfoFromApi($idCinema)
	{
		/* if ($page == NULL) {
			$page = 1;
		} */

		$apiMovie = array();

		$arrayToDecode = ApiResponse::HomologatesApiResponse('/movie/now_playing');

		foreach ($arrayToDecode["results"] as $valuesArray) {

			$movie = new Movies();
			
			$movie->setIdMovieIMDB($valuesArray["id"]);

			if ($valuesArray["poster_path"] != NULL) {
				$posterPath = "https://image.tmdb.org/t/p/w500" . $valuesArray["poster_path"];
			} else {
				$posterPath = IMG_PATH . "noImage.jpg";
			}

			$movie->setPhoto($posterPath);
			$movie->setMovieName($valuesArray["title"]);
			$movie->setReleaseDate($valuesArray["release_date"]);
			

			if ($this->moviesDAO->getIsPlayingMovie($movie, $idCinema)) { 
				$movie->setIsPlaying(true);
			}
			array_push($apiMovie, $movie);
		}
		return $apiMovie;
	}

	private function getInfoMovieApi($idMovieIMDB)
	{
		$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES);

		$get_data = IMDBController::callAPI('GET', API_MAIN_LINK . '/movie' . '/' . $idMovieIMDB, $arrayReque);
		$arrayToDecode = json_decode($get_data, true);

		$movies = new Movies();

		$movies->setIdMovieIMDB($arrayToDecode["id"]);

		if ($arrayToDecode["poster_path"] != NULL) {
			$posterPath = "https://image.tmdb.org/t/p/w500" . $arrayToDecode["poster_path"];
		} else {
			$arrayToDecode = IMG_PATH . "noImage.jpg";
		}

		$movies->setPhoto($posterPath);
		$movies->setMovieName($arrayToDecode["title"]);
		$movies->setReleaseDate($arrayToDecode["release_date"]);
		$movies->setDuration($arrayToDecode["runtime"]);
		$movies->setSynopsis($arrayToDecode["overview"]);
		$movies->setBudget($arrayToDecode["budget"]);
		$movies->setEarnings($arrayToDecode["revenue"]);
		$movies->setOriginalLanguage($arrayToDecode["original_language"]);

		$genreMovie = array();
		foreach ($arrayToDecode["genres"] as $genre) {
			array_push($genreMovie, $genre["id"]);
		}


		return $movies;
	}

	public function GetNowPlayingMoviesFromApi()
	{
		return ApiResponse::HomologatesApiResponse('/movie/now_playing');
	}

	public function GetPosterFromApi($movieIdIMDB)
	{
		$respuesta = ApiResponse::HomologatesApiResponse('/movie/' . $movieIdIMDB . '/images');
		return IMG_LINK . $respuesta['posters'][0]['file_path'];
	}

	

	public function ShowDataBaseMovies()
	{
		$movieList = $this->moviesDAO->getAll();
		require_once(VIEWS_PATH . "MoviesPlayingView.php");
	}

	public function RemoveMovie($idMovieIMDB)
	{

		if ($_GET['IdMovieIMDB'] != null) {

			$idMovieIMDB = $_GET['IdMovieIMDB'];
			$movies = $this->moviesDAO->getByIdMovieIMDB($idMovieIMDB);
		} else {
			$idMovieIMDB = 0;
		}


		if ($movies->getIdMovieIMDB() == $idMovieIMDB) { //<-------------------------------------------
			$this->moviesDAO->remove($movies);
		}

		$this->ShowApiMovies($movieList = null);
	}

	public function SearchByName($movieName)
	{
		if ($movieName != null) {
			$movieList = $this->moviesDAO->getByMovieName($movieName);
		} else {
			$movieName = 0;
		}
		require_once(VIEWS_PATH . "MoviesPlayingView.php");
	}

	public function GetMovieFromApiByName($movieName)
	{
		$movieList = array();

		$arrayToDecode = ApiResponse::HomologatesApiResponse('/movie/now_playing');


		foreach ($arrayToDecode["results"] as $valuesArray) {

			if (similar_text($valuesArray["title"], $movieName) > 1) {
				$movies = new Movies();
				$movies->setIdMovieIMDB($valuesArray["id"]);

				if ($valuesArray["poster_path"] != NULL) {
					$posterPath = "https://image.tmdb.org/t/p/w500" . $valuesArray["poster_path"];
				} else {
					$posterPath = IMG_PATH . "noImage.jpg";
				}

				$movies->setPhoto($posterPath);
				$movies->setMovieName($valuesArray["title"]);
				$movies->setReleaseDate($valuesArray["release_date"]);

				if ($this->moviesDAO->getByIdMovieIMDB($valuesArray["id"]) != null) {
					$movies->setIsPlaying(true);
				}
				array_push($movieList, $movies);
			}
		}
		require_once(VIEWS_PATH . "AdminMoviesPlayingView.php");
	}
	public function GetMovieByCity()
	{
		$var = json_encode($this->moviesDAO->GetMoviesByCity($_POST["cityId"]));
		return $var;
	}
}
