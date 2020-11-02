<?php

namespace Controllers;

use DAO\MovieGenreDAO as MovieGenreDAO;
use Models\MovieGenre as MovieGenre;
use Exception;
use API\IMDBController as IMDBController;
use Util\ApiResponse as ApiResponse;


class MovieGenreController{

    private $movieGenreDAO;
	
    function __construct()
    {
        $this->movieGenreDAO = new MovieGenreDAO();
    }

    public function getGenresFromApi(){

        $arrayToDecode = $this->HomologatesApiResponse('/genre/movie/list');

        foreach($arrayToDecode['genres'] as $values){
            $genre = new MovieGenre();
            $genre->setIdIMDB($values["id"]);
            $genre->setName($values["name"]);
               
            $this->movieGenreDAO->add($genre);
        }
    }

    public function getGenresFromDataBaseAdmin(){

        $genreList = array();
        $genreList = $this->MovieGenreDAO->getAll();
		return $genreList;
    }
}