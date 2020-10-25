<?php

namespace Interfaces;

interface IMoviesDAO
{
    public function GetMoviesByCity($CityId);
    function getAll();
    function add($movies);
    function AddToDatabase($idMovieIMDB);
    function remove($movies);
    function getMovies($movies);
}
