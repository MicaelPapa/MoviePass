<?php

	namespace Controllers;

	use API\APIController as APIController;
	use DAO\GenreDAO as GenreDAO;
	use Models\Genre as Genre;
	
	class GenreController
	{
		private $genreDAO;
	
		function __construct()
		{
			$this->genreDAO = new GenreDAO();
		}
	
		public function getGenresFromApi()
		{
			$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES);
	
			$get_data = APIController::callAPI('GET', API . '/genre/movie/list', $arrayReque);
	
			$arrayToDecode = json_decode($get_data, true);
	
            foreach ($arrayToDecode["genres"] as $genreValues) 
			{
				$genre = new Genre();
				$genre->setId($genreValues["id"]);
				$genre->setName($genreValues["name"]);
				   
                $this->genreDAO->add($genre);
            }

			Functions::getInstance()->redirect("System");
		}
	}
?>