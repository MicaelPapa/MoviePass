<?php 

namespace Interfaces;

interface IStatisticsDAO 
{
    public function LoadTheMostPopularMovies();
    public function LoadTheLessPopularMovies();
}


?>