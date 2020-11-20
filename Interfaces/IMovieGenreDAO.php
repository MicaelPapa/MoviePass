<?php
    namespace Interfaces;
    interface IMovieGenreDAO
    {
        function getAll();
        function add($movieGenre);
        function remove($movieGenre);
        function getMovieGenre($movieGenre);
        function isIdIMDB($idIMDB);
        function getAllMoviexGenres();
        function addMoviexGenres($IdGenreIMDB, $IdMovieIMDB);
        function removeMoviexGenres($IdMovieGenre);
        function getIdMovie($IdGenreIMDB);
        function getIdGenre($IdGenre);
        function isIdIMDBmXg($idIMDB);
        function getGenresId();
    }
?>