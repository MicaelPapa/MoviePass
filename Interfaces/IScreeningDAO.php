<?php
    namespace Interfaces;
    interface IScreeningDAO
    {
    function add($screening);
    function GetAll();
    function GetScreeningById($idScreening);
    function remove($screening);
    function edit($screening);
    function GetScreeningByIdMovie($movies);
    function GetScreeningByIdCinema($idCinema);
    function existInDataBase($idMovieIMDB);
    }
?>