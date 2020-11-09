<?php

namespace Interfaces;

interface IMoviesDAO
{

    function getAll();
    function Add($movies, $idCinema);
    function AddToDatabase($idMovieIMDB);
    function remove($movies, $idCinema);
    function getMovie($movie);
}
