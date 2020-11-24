<?php
    namespace Interfaces;

    
    interface IScreeningDAO
    {
    function Add($screening, $idCinema);
    function GetAll();
    function GetScreeningById($idScreening);
    function remove($screening);
<<<<<<< HEAD
    function GetScreeningsByIdMovie($movies);
=======
    function GetScreeningsByMovie($movie);
>>>>>>> a8da36ebdfe3195beec5005e24932c7150fbed2c
    function existInDataBase($idMovieIMDB);
    public function distinctScreeningPerDay($screening);
    public function validateScreening($screening);
    public function getAllIdMoviesByDate($date);
    public function GetSpecificScreeningByMovie($movie);
    public function getCinemaByIdCinema($idCinema);
    }
?>