<?php
    namespace Interfaces;

    
    interface IScreeningDAO
    {
    function Add($screening, $idCinema);
    function GetAll();
    function GetScreeningById($idScreening);
    function remove($screening);
    function edit($screening);
    function GetScreeningsByIdMovie($movies);
    function GetScreeningByIdCinema($idCinema);
    function existInDataBase($idMovieIMDB);
    }
?>