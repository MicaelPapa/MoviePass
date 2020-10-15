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

    public function View()
    {
        $bestMovies = $this->statisticsDAO->LoadTheMostPopularMovies();
        $worstMovies = $this->statisticsDAO->LoadTheLessPopularMovies();
        if(sizeof($bestMovies,COUNT_NORMAL) === 0)
            $alertMessage = "No hay datos para realizar estadisticas";
        require_once(VIEWS_PATH . "StatisticsView.php");
    }
}
