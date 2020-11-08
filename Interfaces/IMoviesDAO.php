<?php

namespace Interfaces;

interface IMoviesDAO
{
    public function GetMoviesByCity($CityId);
    function getAll();
    function Add($movies, $idCinema);
    function AddToDatabase($idMovieIMDB);
    function remove($movies, $idCinema);
    function getMovie($movie);
}
