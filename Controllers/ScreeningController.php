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


	public function ShowListView($idMovieIMDB, $idCinema) //Recibe el id de la pelicula y el cine, arma los objetos y muestra las funciones.
	{
		$cinemas = array();
		$rooms = array();
		$movie = new Movies();
		$cinema = new Cinema();

		$movie = $this->moviesDAO->getByIdMovieIMDB($idMovieIMDB);
		$cinema = $this->cinemaDAO->GetCinemaById($idCinema);
		$screenings = $this->GetAll($movie);
		$rooms = $this->roomDAO->GetRoomsByCinema($idCinema);

		require_once(VIEWS_PATH . "ScreeningView.php");
	}

	public function GetAll($movie){

		$room = new Room();
		$cinema = new Cinema();

		$screenings = array();
		$screeningsList = $this->screeningDAO->GetScreeningsByMovie($movie);

		foreach ($screeningsList as $screening) {
			if ($screening->getIdScreening() != "-") {
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

	public function Add($fechaorigen, $fechafinal, $hora, $precio, $idRoom, $dimension, $audio, $sub, $idMovieIMDB, $idCinema){
		
		$validate = true;
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
		$screening->setFinishHour($newDate); //Calcula la hora en que termina la pelicula a partir de la duracion y la setea en el objeto screening
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

	public function RemoveFromDataBase($IdScreening, $idCinema)
	{

		$movie = new Movies();
		$screening = new Screening();
		$screening = $this->screeningDAO->GetScreeningById($IdScreening);
		$movie = $this->moviesDAO->getByIdMovieIMDB($screening->getIdMovieIMDB()); //arma la movie
		$screening = $this->screeningDAO->remove($screening);
		$this->ShowListView($movie->getIdMovieIMDB(), $idCinema);
	}
}
