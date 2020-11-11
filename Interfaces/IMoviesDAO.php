<?php

namespace Interfaces;

interface IMoviesDAO
{

    function getAll();
    function Add($movies, $idCinema);
    function remove($movies, $idCinema);
    function getMovie($movie);
}
