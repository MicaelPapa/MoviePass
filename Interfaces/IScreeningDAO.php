<?php
    namespace Interfaces;

    
    interface IScreeningDAO
    {
    function Add($screening, $idCinema);
    function GetAll();
    function GetScreeningById($idScreening);
    function remove($screening);
    function GetScreeningsByMovie($movie);
    function existInDataBase($idMovieIMDB);
    public function distinctScreeningPerDay($screening);
    public function validateScreening($screening);
    public function getAllIdMoviesByDate($date);
    public function GetSpecificScreeningByMovie($movie);
    public function getCinemaByIdCinema($idCinema);
    }
?>