<?php
    namespace Interfaces;
    use DAO\Connection as Connection;

    interface ICitiesDAO
    {
        function GetAll();
        public function GetAllStates();
        public function getCitiesObjectByState($idState);
        public function getCitiesByState($idState);
        public function getIdCitiesByName($cityName);
        public function getState($idState);
        public function getCity($idCity);
        public function getStateByCountry($idCountry);
        public function getCountry($idCountry);
        public function getAllCountries();


    }
?>
