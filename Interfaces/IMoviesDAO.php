<?php
    namespace Interfaces;
    interface IMoviesDAO
    {
    function getAll();
    function add($movies); 
    function AddToDatabase($idMovieIMDB);
    function remove($movies);
	function getMovies($movies);
    }
?>