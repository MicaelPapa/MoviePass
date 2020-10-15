<?php
    namespace Interfaces;
    interface IMovieGenreDAO
    {
        function getAll();
        function add($movieGenre);
        function remove($movieGenre);
        function getMovieGenre($movieGenre);
        function isIdIMDB($idIMDB);
    }
?>