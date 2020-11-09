<?php

namespace Controllers;

use DAO\ScreeningDAO as ScreeningDAO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\MoviesDAO as MoviesDAO;
use DAO\RoomDAO as RoomDAO;
use Models\Screening as Screening;
use Models\Cinema as Cinema;
use Models\Movies as Movies;
use Models\Room as Room;

class ScreeningController
{

	private $moviesDAO;
	private $screeningDAO;
	private $cinemaDAO;
	private $roomDAO;
	
	function __construct()
	{
		$this->moviesDAO = new MoviesDAO();
		$this->screeningDAO = new ScreeningDAO();
		$this->cinemaDAO = new CinemaDAO();
		$this->roomDAO = new RoomDAO();
	}


	public function ShowListView($idMovieIMDB, $idCinema)
	{
		$cinemas = array();
		$rooms = array();
		$movie = new Movies();
		$cinema = new Cinema();
		if ($idMovieIMDB != NULL) {
			$cinema = $this->cinemaDAO->GetCinemaById($idCinema);
			$movie = $this->moviesDAO->getByIdMovieIMDB($idMovieIMDB);
			$screenings = $this->GetAll($movie);
			$cinemas = $this->cinemaDAO->getAll();
			$rooms = $this->roomDAO->GetRoomsByCinema($idCinema);
		} else {
			$screenings = $this->screeningDAO->GetScreeningsByIdMovie($idMovie);
			$cinemas = $this->cinemaDAO->getAll();
		}
		require_once(VIEWS_PATH . "ScreeningView.php");
	}

	
	public function GetAll($movie)
	{	

		$room = new Room();
		$cinema = new Cinema();
		
		$screenings = array ();
		
		$screeningsList = $this->screeningDAO->GetScreeningsByIdMovie($movie);

	
			foreach ($screeningsList as $screening)
			{
			
				if($screening->getIdScreening() != "-")
				{
					$idRoom = $screening->getRoom()->getIdRoom();
					$room = $this->roomDAO->GetRoomById($idRoom);
					$screening->setRoom($room);
					$cinema = $this->cinemaDAO->GetCinemaById($screening->getCinema()->getIdCinema());
					$screening->setCinema($cinema);
					$movie = $this->moviesDAO->getByMovieId($screening->getMovie()->getIdMovie());
					$screening->setMovie($movie);


				} 
	
			}
	
		
	
		return $screeningsList;
	}

	public function Add($fechaorigen, $fechafinal, $hora, $precio, $idRoom, $dimension, $audio, $sub,$idMovieIMDB, $idCinema) //fecha1 fecha 2  horario inicio  dimension  sala  audio precio subtitulos 
	{
		$validate =true;
		$continue = true;
		$i = 0;
		$screening = new Screening();
		$movie  = new Movies();
		$cinema = new Cinema();
		$room = new Room();

		$cinema->setIdCinema($idCinema);
		$movie = $this->moviesDAO->getByIdMovieIMDB($idMovieIMDB);
		$room = $this->roomDAO->getRoomById($idRoom);

		$screening->setCinema($cinema);
		$screening->setMovie($movie);
		$screening->setRoom($room);
		$screening->setStartDate($fechaorigen);
		$screening->setLastDate($fechafinal);

		$date = $fechaorigen . " " . $hora;
		$date = strtotime($date);
		$date = date('Y-m-d H:i:s', $date);
		$screening->setStartHour($date);

		//Calcula la hora en que termina la pelicula


		$duration = $movie->getDuration();
		$dateHour = $fechaorigen . " " . $hora;
		$stringHour = "+" . $duration . " minutes";
		$newDate = strtotime($stringHour, strtotime($dateHour));
		$newDate = date('Y-m-d H:i:s', $newDate);

		$screening->setFinishHour($newDate);

		$screening->setDimension($dimension);

		$screening->setAudio($audio);
		$screening->setPrice($precio);
		$screening->setSubtitles($sub);
		$screening->setRemainTickets($room->getCapacity());

		$screeningsXday = array();
		$screeningsXday = $this->screeningDAO->distinctScreeningPerDay($screening);

		while ($i <  sizeof($screeningsXday) or $continue) {
			$value = $screeningsXday[$i];

			$validate = ($this->screeningDAO->validateScreening($value));

			$alertMessage = array_shift($validate);

			$validate = array_shift($validate);

			if (!$validate) {
				echo '<script>alert("' . $alertMessage . '");</script>';
				$continue = false;
			} else if ($i < sizeof($screeningsXday)) $continue = false;

			$i++;
		}
		if ($validate) {
			foreach ($screeningsXday as $value) {
				$this->screeningDAO->Add($value, $idCinema);
			}
		}

		$this->ShowListView($idMovieIMDB, $idCinema);
	
	}


	public function EditScreening($idMovieIMDB)
	{

		$movie = $this->moviesDAO->getByIdMovieIMDB($_GET['idMovieIMDB']);
		$screening->setStartDate($_GET['inputFechaDesde']);
		$screening->setLastDate($_GET['inputFechaHasta']);
		$screening->setStartHour($_GET['inputHoraInicio']);
		$duration = $movie->getDuration();
		$dateHour = $_GET['inputFechaDesde'] . " " . $_GET['inputHoraInicio'];
		$stringHour = "+" . $duration . " minutes";
		$newDate = strtotime($stringHour, strtotime($dateHour));
		$newDate = date('Y-m-d H:i:s', $newDate);
		$screening->setFinishHour($newDate);
		$screening->setIdCinema($_GET['inputCinema']);
		$screening->setIdRoom($_GET['inputSala']);
		$screening->setDimension($_GET['dimension']);
		$screening->setIdCinema($_GET['inputCinema']);
		$screening->setIdRoom($_GET['inputSala']);
		$screening->setAudio($_GET['audio']);
		$screening->setPrice($_GET['price']);
		$screening->setSubtitles($_GET['subtitulos']);

		$this->screeningDAO->edit($screening);

		require_once(VIEWS_PATH . "ScreeningView.php");
	}

	public function RemoveFromDataBase($IdScreening, $idCinema)
	{

		if ($_GET['IdScreening'] != null) {

			$movie = new Movies();
			$screening = new Screening();
			$screening = $this->screeningDAO->GetScreeningById($IdScreening);
			$movie = $this->moviesDAO->getByIdMovieIMDB($screening->getIdMovieIMDB());
			$screening = $this->screeningDAO->remove($screening);
		}
		$idMovieIMDB = $movie->getIdMovieIMDB();
		$this->ShowListView($idMovieIMDB, $idCinema);
	}
}
