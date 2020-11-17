<?php

namespace Controllers;

use DAO\StatisticsDAO as StatisticsDAO;

class StatisticsController
{
    private $statisticsDAO;

    public function __construct()
    {
        $this->statisticsDAO = new StatisticsDAO();
    }

    public function View($date1, $date2)
    {
        if($date1 != "null"){
            $bestMovies = $this->statisticsDAO->LoadTheMostPopularMoviesByDate($date1,$date2);
        }else{
            $bestMovies = $this->statisticsDAO->LoadTheMostPopularMovies();
        }  

        $worstMovies = $this->statisticsDAO->LoadTheLessPopularMovies();
        $boxOfficeMovies = $this->statisticsDAO->LoadMostBoughtMovies();

        if(sizeof($bestMovies,COUNT_NORMAL) === 0)
            $alertMessage = "No hay datos para realizar estadisticas";

        require_once(VIEWS_PATH . "StatisticsView.php");
    }

    public function LoadMoviesByDate($date){
        $bestMovies = $this->statisticsDAO->LoadTheMostPopularMovies();
    }
}
