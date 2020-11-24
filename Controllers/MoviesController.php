<?php

namespace Controllers;

use DAO\MoviesDAO as MoviesDAO;
use DAO\MovieGenreDAO as MovieGenreDAO;
use DAO\ScreeningDAO as ScreeningDAO;
use DAO\CinemaDAO as CinemaDAO;
use Models\Movies as Movies;
use Models\MovieGenre as MovieGenre;
use Models\Cinema as Cinema;
use API\IMDBController as IMDBController;
use Controllers\ScreeningController as ScreeningController;
use Util\apiResponse as ApiResponse;


class MoviesController
{
	private $moviesDAO;
	private $movieGenreDAO;
	private $screeningDAO;
	private $cinemaDAO;

	public function __construct()
	{
		$this->moviesDAO = new MoviesDAO();
		$this->movieGenreDAO = new MovieGenreDAO();
		$this->screeningDAO = new ScreeningDAO();
		$this->cinemaDAO = new CinemaDAO();
	}


	public function AddMovieToDatabase($idCinema, $idMovieIMDB)
	{
		if ($idMovieIMDB == null) {

			$idMovieIMDB = 0;
		}

		$movie = null;
		$cinema = new Cinema();
		$cinema->setIdCinema($idCinema);
		$movie = $this->moviesDAO->getByIdMovieIMDB($idMovieIMDB);

		if ($movie == null) {
			$movie = $this->getInfoMovieApi($idMovieIMDB);
			$this->moviesDAO->Add($movie, $cinema);
			$this->addGenreAndMovie($movie->getGenres(), $movie->getIdMovieIMDB());
		} else if (!$this->moviesDAO->isExistMovieXCinema($cinema, $movie)) { //valida que no exista esa pelicula para ese cine

			$this->moviesDAO->setMovieXcinema($cinema, $movie);
		}

		$this->ShowApiMovies("La pelicula se ha agregado correctamente", "success", null, null, $idCinema);
	}




	public function ShowApiMovies($alertMessage = "", $alertType = "", $filterType = "", $filter = "", $idCinema)
	{

		$movieList = $this->getNowPlayingMoviesInfoFromApi($filterType, $filter, $idCinema);
		$genreList = $this->getGenresFromDataBase();
		$this->getGenresFromApi();

		require_once(VIEWS_PATH . "AdminMoviesPlayingView.php");
	}

	public function getNowPlayingMoviesInfoFromApi($type, $filter, $idCinema)
	{

		$apiMovie = array();
		$arrayToDecode = ApiResponse::HomologatesApiResponse('/movie/now_playing');

		if ($type == "filterGenres") {
			foreach ($arrayToDecode['results'] as $movie) {
				foreach ($movie['genre_ids'] as $movieGenre) {
					if ($movieGenre == $filter) {
						$newMovies = $this->getMovieFromApi($movie['id'], $arrayToDecode, $idCinema);
						array_push($apiMovie, $newMovies);
					}
				}
			}
		} else if ($type == "filterName") {
			foreach ($arrayToDecode["results"] as $movie) {
				if (similar_text($movie["title"], $filter) > 2) {
					$newMovies = $this->getMovieFromApi($movie['id'], $arrayToDecode, $idCinema);
					array_push($apiMovie, $newMovies);
				}
			}
		} else {
			foreach ($arrayToDecode["results"] as $movie) {
				if ($this->cinemaDAO->existMoviesInCinema($idCinema)) {
					$newMovies = $this->getMovieFromApi($movie['id'], $arrayToDecode, $idCinema);
					$moviesCinema = $this->moviesDAO->getByCinema($idCinema);
					$flag = null;
					foreach ($moviesCinema as $mc) {
						if ($newMovies->getIdMovieIMDB() == $mc->getIdMovieIMDB()) {
							$flag = false;
						}
						if ($flag === null && $moviesCinema[sizeof($moviesCinema) - 1] === $mc) {
							$flag = true;
						}
					}
					if ($flag) {
						array_push($apiMovie, $newMovies);
					}
				} else {
					$newMovies = $this->getMovieFromApi($movie['id'], $arrayToDecode, $idCinema);
					array_push($apiMovie, $newMovies);
				}
			}
		}
		return $apiMovie;
	}

	private function getInfoMovieApi($idMovieIMDB)
	{
		$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES);

		$get_data = IMDBController::callAPI('GET', API_MAIN_LINK . '/movie' . '/' . $idMovieIMDB, $arrayReque);
		$arrayToDecode = json_decode($get_data, true);

		$movie = new Movies();

		$movie->setIdMovieIMDB($arrayToDecode["id"]);

		if ($arrayToDecode["poster_path"] != NULL) {
			$posterPath = "https://image.tmdb.org/t/p/w500" . $arrayToDecode["poster_path"];
		} else {
			$arrayToDecode = IMG_PATH . "noImage.jpg";
		}

		$movie->setPhoto($posterPath);
		$movie->setMovieName($arrayToDecode["title"]);
		$movie->setReleaseDate($arrayToDecode["release_date"]);
		$movie->setDuration($arrayToDecode["runtime"]);
		$movie->setSynopsis($arrayToDecode["overview"]);
		$movie->setBudget($arrayToDecode["budget"]);
		$movie->setEarnings($arrayToDecode["revenue"]);
		$movie->setOriginalLanguage($arrayToDecode["original_language"]);
		$movie->setGenres($arrayToDecode["genres"]);

		return $movie;
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



	public function ShowDataBaseMovies($type, $filter)
	{
		$movieList = array();
		$genreList = array();
		$movie = new Movies();
		$this->getGenresFromApi();
		if ($type == "filterGenres") {
			$movieGenreList = $this->movieGenreDAO->getIdMovie($filter);
			foreach ($movieGenreList as $IdMovieIMDB) {
				$movie = $this->moviesDAO->getByIdMovieIMDB($IdMovieIMDB['IdMovieIMDB']);
				array_push($movieList, $movie);
			}
		} else if ($type == "filterName") {
			if ($filter != null) {
				$movieList = $this->moviesDAO->getByMovieName($filter);
			}
		} else if ($type == "filterDate") {
			$dateMovies = $this->getMoviesScreeningDataBase($filter);
			foreach ($dateMovies as $idMovieIMDB) {
				$movie =  $this->moviesDAO->getByIdMovieIMDB($idMovieIMDB["IdMovieIMDB"]);
				array_push($movieList, $movie);
			}
		} else {
			$movieList = $this->moviesDAO->getAll();
		}

		$genresDataBaseList = $this->getGenresFromDataBaseAdmin();
		foreach ($genresDataBaseList as $genre) {
			foreach ($movieList as $movie) {
				if ($genre['IdMovieIMDB'] == $movie->getIdMovieIMDB()) {
					$newGenre = $this->movieGenreDAO->getGenreById($genre['IdGenreIMDB']);
					array_push($genreList, $newGenre);
				}
			}
		}
		require_once(VIEWS_PATH . "MoviesPlayingView.php");
	}

	public function ShowDataBaseMoviesAdmin($alertMessage = "", $alertType = "", $filterType = "", $filter = "", $idCinema)
	{
		$movieList = array();
		$genreList = array();
		$movie = new Movies();
		$this->getGenresFromApi();
		if ($filterType == "filterGenres") {
			$movieGenreList = $this->movieGenreDAO->getIdMovie($filter);
			$movieCinemaList = $this->moviesDAO->getByCinema($idCinema);
			foreach ($movieGenreList as $IdMovieIMDB) {
				$movie = $this->moviesDAO->getByIdMovieIMDB($IdMovieIMDB['IdMovieIMDB']);
				foreach ($movieCinemaList as $movieCinema) {
					if ($movieCinema->getIdMovieIMDB() === $movie->getIdMovieIMDB()) {
						array_push($movieList, $movie);
					}
				}
			}
		} else if ($filterType == "filterName") {
			if ($filter != null) {
				$movieCinemaList = $this->moviesDAO->getByCinema($idCinema);
				$movieNameList = $this->moviesDAO->getByMovieName($filter);
				foreach ($movieNameList as $movie) {
					foreach ($movieCinemaList as $movieCinema) {
						if ($movieCinema->getIdMovieIMDB() === $movie->getIdMovieIMDB()) {
							array_push($movieList, $movie);
						}
					}
				}
			}
		} else if ($filterType == "filterDate") {
			$dateMovies = $this->getMoviesScreeningDataBase($filter);
			$movieCinemaList = $this->moviesDAO->getByCinema($idCinema);
			foreach ($dateMovies as $idMovieIMDB) {
				$movie =  $this->moviesDAO->getByIdMovieIMDB($idMovieIMDB["IdMovieIMDB"]);
				foreach ($movieCinemaList as $movieCinema) {
					if ($movieCinema->getIdMovieIMDB() === $movie->getIdMovieIMDB()) {
						array_push($movieList, $movie);
					}
				}
			}
		} else {
			$movieList = $this->moviesDAO->getByCinema($idCinema);
		}
		$genresDataBaseList = $this->getGenresFromDataBaseAdmin();
		foreach ($genresDataBaseList as $genre) {
			foreach ($movieList as $movie) {
				if ($genre['IdMovieIMDB'] == $movie->getIdMovieIMDB()) {
					$newGenre = $this->movieGenreDAO->getGenreById($genre['IdGenreIMDB']);
					array_push($genreList, $newGenre);
				}
			}
		}

		require_once(VIEWS_PATH . "ManageDataBaseMoviesView.php");
	}


	public function RemoveMovie($idMovieIMDB, $idCinema)
	{

		if ($idMovieIMDB != null) {

			$movies = $this->moviesDAO->getByIdMovieIMDB($idMovieIMDB);
		} else {
			$idMovieIMDB = 0;
		}


		if ($movies->getIdMovieIMDB() === $idMovieIMDB) {
			$this->moviesDAO->remove($movies, $idCinema);
		}

		$this->ShowDataBaseMoviesAdmin("La pelicula se borro satisfactoriamente", "danger", null, null, $idCinema);
	}

	private function getGenresFromDataBase()
	{

		$movieGenreList = array();
		$movieGenreList = $this->movieGenreDAO->getAll();
		$genreList = array();
		foreach ($movieGenreList as $genre) {
			$movieGenre = new MovieGenre();
			$movieGenre = $genre;
			array_push($genreList, $movieGenre);
		}
		return $genreList;
	}


	private function addGenreAndMovie($genres, $IdMovie)
	{
		foreach ($genres as $idGenre) {
			$this->movieGenreDAO->addMoviexGenres($idGenre['id'], $IdMovie);
		}
	}


	public function getMovieFromApi($IdMovieIMDB, $moviesArray, $idCinema)
	{

		$movies = new Movies();
		foreach ($moviesArray["results"] as $valuesArray) {

			if ($valuesArray["id"] == $IdMovieIMDB) {
				$movies->setIdMovieIMDB($valuesArray["id"]);

				if ($valuesArray["poster_path"] != NULL) {
					$posterPath = "https://image.tmdb.org/t/p/w500" . $valuesArray["poster_path"];
				} else {
					$posterPath = IMG_PATH . "noImage.jpg";
				}

				$movies->setPhoto($posterPath);
				$movies->setMovieName($valuesArray["title"]);
				$movies->setReleaseDate($valuesArray["release_date"]);

				if ($this->moviesDAO->getIsPlayingMovie($movies, $idCinema)) {
					$movies->setIsPlaying(true);
				} else {
					$movies->setIsPlaying(false);
				}
			}
		}
		return $movies;
	}

	private function getMoviesScreeningDataBase($date)
	{
		$movies = $this->screeningDAO->getAllIdMoviesByDate($date);
		return $movies;
	}
	public function ShowScreeningUserView($idMovie)
	{
		$movie = $this->moviesDAO->getByMovieId($idMovie);
		$screeningList = $this->screeningDAO->GetSpecificScreeningByMovie($movie);
		usort($screeningList, array($this, "sortFunctionByDate"));
		$screeningListCopy = $screeningList;
		$screeningCondition = null;
		require_once(VIEWS_PATH . "SelectScreeningUserView.php");
	}
	function sortFunctionByDate($a, $b)
	{
		return strtotime($a->getStartDate()) - strtotime($b->getStartDate());
	}

	public function getGenresFromApi()
	{

		$arrayToDecode = ApiResponse::HomologatesApiResponse('/genre/movie/list');

		if ($this->movieGenreDAO->getAll() == null) {
			foreach ($arrayToDecode['genres'] as $values) {
				$genre = new MovieGenre();
				$genre->setIdIMDB($values["id"]);
				$genre->setName($values["name"]);

				$this->movieGenreDAO->add($genre);
			}
		}
	}
	public function getGenresFromDataBaseAdmin()
	{

		$genreList = array();
		$genreList = $this->movieGenreDAO->getGenresId();
		return $genreList;
	}
}
