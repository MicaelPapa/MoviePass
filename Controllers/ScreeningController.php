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

class ScreeningController{

	private $moviesDAO;
	private $screeningDAO;
	private $cinemaDAO;
	
	function __construct()
	{
		$this->moviesDAO = new MoviesDAO();
		$this->screeningDAO = new ScreeningDAO();
		$this->cinemaDAO = new CinemaDAO();
		$this->roomDAO = new RoomDAO();

	}

	public function View($idMovieIMDB){
				$screenings = array();
				$cinemas = array();
				$rooms = array();
				$movies = new Movies();

				if($idMovieIMDB != NULL)
				{
					$movies = $this->moviesDAO->getByIdMovieIMDB($idMovieIMDB);
					$screenings = $this->screeningDAO->getScreeningByIdMovie($movies);
					$cinemas = $this->cinemaDAO->getAll();
					$rooms = $this->roomDAO->getAll();
				}
				else
				{
					$screenings = $this->screeningDAO->getScreeningByIdMovie($idMovie);
					$cinemas = $this->cinemaDAO->getAll();
				}
				require_once(VIEWS_PATH."ScreeningView.php");
	}
	public function AddScreeningToDatabase($idMovieIMDB){
		
		$screening = new Screening();
			
			$movies = $this->moviesDAO->getByIdMovieIMDB($_GET['idMovieIMDB']);
			$screening->setIdMovie($movies->getIdMovie());
			$screening->setIdMovieIMDB($movies->getIdMovieIMDB());
			$screening->setStartDate($_GET['inputFechaDesde']);
			$screening->setLastDate($_GET['inputFechaHasta']);
			$screening->setStartHour($_GET['inputHoraInicio']);
			
			//Calcula la hora en que termina la pelicula

			$duration = $movies->getDuration();
			$dateHour=$_GET['inputFechaDesde'] ." ".$_GET['inputHoraInicio'];
			$stringHour = "+".$duration." minutes";
			$newDate = strtotime($stringHour,strtotime($dateHour));
			$newDate= date('Y-m-d H:i:s', $newDate);

			$screening->setFinishHour($newDate);
			$screening->setIdCinema(1);
			$screening->setIdRoom(1);
			$screening->setDimension($_GET['dimension']);

			$screening->setIdCinema($_GET['inputCinema']);
			$screening->setIdRoom($_GET['inputSala']);
			$screening->setAudio($_GET['audio']);
			$screening->setPrice($_GET['price']);
			$screening->setSubtitles($_GET['subtitulos']);

			$screeningsXday = array();
			$screeningsXday = $this->screeningDAO->distinctScreeningPerDay($screening);

			foreach($screeningsXday as $dateScreening){
			
				if($this->screeningDAO->validateScreening($dateScreening)){
					$this->screeningDAO->add($dateScreening);
				}
				else echo "La existe una función a esa hora";
			}

			$screenings = array();

			$screenings = $this->screeningDAO->getAll();
			$cinemas = array();
			$rooms = array();

			$screenings = $this->screeningDAO->getScreeningByIdMovie($movies);
			$cinemas = $this->cinemaDAO->getAll();
			$rooms = $this->roomDAO->getAll();



			require_once(VIEWS_PATH."ScreeningView.php");
	}


	public function EditScreening($idMovieIMDB){

		$movies = $this->moviesDAO->getByIdMovieIMDB($_GET['idMovieIMDB']);
		$screening->setStartDate($_GET['inputFechaDesde']);
		$screening->setLastDate($_GET['inputFechaHasta']);
		$screening->setStartHour($_GET['inputHoraInicio']);
		$duration = $movies->getDuration();
		$dateHour=$_GET['inputFechaDesde'] ." ".$_GET['inputHoraInicio'];
		$stringHour = "+".$duration." minutes";
		$newDate = strtotime($stringHour,strtotime($dateHour));
		$newDate= date('Y-m-d H:i:s', $newDate);
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
	
		require_once(VIEWS_PATH."ScreeningView.php");
	}

	public function RemoveFromDataBase($IdScreening){
		
		if($_GET['IdScreening'] != null){
			
			$movies = new Movies();
			$screening = new Screening();
			$screening =$this->screeningDAO->GetScreeningById($IdScreening);
			$movies = $this->moviesDAO->getByIdMovieIMDB($screening->getIdMovieIMDB());
			$screening =$this->screeningDAO->remove($screening);
		}
		$idMovieIMDB = $movies->getIdMovieIMDB();
		$this->View($idMovieIMDB);
	}

}
?>
