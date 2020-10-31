<?php

namespace Controllers;

use DAO\MoviesDAO as MoviesDAO;
use DAO\MovieGenreDAO as MovieGenreDAO;
use DAO\MovieXMovieGenresDAO as MovieXMovieGenresDAO;
use Models\Movies as Movies;
use Models\MovieGenre as MovieGenre;
use API\IMDBController as IMDBController;
use Controllers\ScreeningController as ScreeningController;
use Util\apiResponse as ApiResponse;


class MoviesController
{
	private $moviesDAO;
	private $movieGenreDAO;
	private $movieXgenreDAO;

	public function __construct()
	{
		$this->moviesDAO = new MoviesDAO();
		$this->movieGenreDAO = new MovieGenreDAO();
		$this->movieXgenreDAO = new MovieXMovieGenresDAO();
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
			$this->addGenreAndMovie($movie->getGenres(),$movie->getIdMovieIMDB());

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
		$genreList = $this->getGenresFromDataBase();

		require_once(VIEWS_PATH . "AdminMoviesPlayingView.php");
	}

	public function getNowPlayingMoviesInfoFromApi($idCinema)
	{
		/* if ($page == NULL) {
			$page = 1;
		} */
       $filtro =
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
			$movie->setGenres($valuesArray["genre_ids"]);


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
		$movies->setGenres($arrayToDecode["genres"]);

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
		$genreList = $this->getGenresFromDataBase();
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
		$genreList = $this->getGenresFromDataBase();
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
	
	private function getGenresFromDataBase(){

        $movieGenreList = array();
		$movieGenreList = $this->movieGenreDAO->getAll();
		$genreList = array();
		foreach($movieGenreList as $genre){
			$movieGenre = new MovieGenre();
			$movieGenre = $genre;
			array_push($genreList,$movieGenre);
		}
		return $genreList;
	}
	
	public function filterMoviesApi(){

		$IdIMDB = $_POST['selectGenres'];

		$arrayToDecodeMovie = ApiResponse::HomologatesApiResponse('/movie/now_playing');

		$movies = $arrayToDecodeMovie['results'];
		
		$movieList = array();
		if ($IdIMDB != null) {
			foreach($movies as $movie){
				
					foreach($movie['genre_ids'] as $movieGenre){
						if($movieGenre == $IdIMDB){
							$newMovies = new Movies();
							$newMovies->setIdMovieIMDB($movie["id"]);

							if ($movie["poster_path"] != NULL) {
								$posterPath = "https://image.tmdb.org/t/p/w500" . $movie["poster_path"];
							} else {
								$posterPath = IMG_PATH . "noImage.jpg";
							}

							$newMovies->setPhoto($posterPath);
							$newMovies->setMovieName($movie["title"]);
							$newMovies->setReleaseDate($movie["release_date"]);

							if ($this->moviesDAO->getByIdMovieIMDB($movie["id"]) != null) {
								$newMovies->setIsPlaying(true);
							}
						array_push($movieList, $newMovies);
					}
				}	
			}
		} else {
			$movieName = 0;
		}
		$genreList = $this->getGenresFromDataBase();
		require_once(VIEWS_PATH . "AdminMoviesPlayingView.php");
	}
	public function filterDateMoviesApis($fecha, $idCinema){
		$dateMovie = $_POST['dateFilter'];
		$arrayToDecodeMovie = ApiResponse::HomologatesApiResponse('/movie/now_playing');

		$movies = $arrayToDecodeMovie['results'];
		
		$movieList = array();
		if ($dateMovie != null) {
			foreach($movies as $movie){
				if($movie['release_date'] == $dateMovie){
					$newMovies = new Movies();
					$newMovies->setIdMovieIMDB($movie["id"]);
					if ($movie["poster_path"] != NULL) {
						$posterPath = "https://image.tmdb.org/t/p/w500" . $movie["poster_path"];
					} else {
						$posterPath = IMG_PATH . "noImage.jpg";
					}
					$newMovies->setPhoto($posterPath);
					$newMovies->setMovieName($movie["title"]);
					$newMovies->setReleaseDate($movie["release_date"]);
					if ($this->moviesDAO->getByIdMovieIMDB($movie["id"]) != null) {
						$newMovies->setIsPlaying(true);
					}
					array_push($movieList, $newMovies);
				}	
			}
		} else {
			$movieName = 0;
		}
		$genreList = $this->getGenresFromDataBase();
		require_once(VIEWS_PATH . "AdminMoviesPlayingView.php");
	}

	private function addGenreAndMovie($genres, $IdMovie){
		foreach($genres as $idGenre){
			$this->movieXgenreDAO->add($idGenre['id'], $IdMovie);
		}
	}

	public function filterDataBaseMoviesByGenre(){

		$movieGenreList = $this->movieXgenreDAO->getIdMovie($_POST['selectGenres']);
		$movieList = array();

		foreach ($movieGenreList as $IdMovieIMDB){
			$movie = $this->moviesDAO->getByIdMovieIMDB($IdMovieIMDB['IdMovieIMDB']);
			array_push($movieList, $movie);
		}
		
		$genreList = $this->getGenresFromDataBase();
		require_once(VIEWS_PATH . "MoviesPlayingView.php");
	}

	public function filterDateMoviesDataBase(){
		
		$dateMovie = $_POST['dateFilter'];
		$listDateMovies = $this->moviesDAO->getAll();
		$movieList = array();
		foreach($listDateMovies as $movie){
			if($movie->getReleaseDate() == $dateMovie){
				array_push($movieList, $movie);	
			}
		}
		$genreList = $this->getGenresFromDataBase();
		require_once(VIEWS_PATH . "MoviesPlayingView.php");
	}
}
