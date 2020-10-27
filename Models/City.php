<?php 
namespace Models;


    class City{

        private $idCity;
        private $cityName;
        private $zipCode;
        private $state;

        

        /**
         * Get the value of idCity
         */ 
        public function getIdCity()
        {
                return $this->idCity;
        }

        /**
         * Set the value of idCity
         *
         * @return  self
         */ 
        public function setIdCity($idCity)
        {
                $this->idCity = $idCity;

                return $this;
        }

        /**
         * Get the value of cityName
         */ 
        public function getCityName()
        {
                return $this->cityName;
        }

        /**
         * Set the value of cityName
         *
         * @return  self
         */ 
        public function setCityName($cityName)
        {
                $this->cityName = $cityName;

                return $this;
        }

        /**
         * Get the value of zipCode
         */ 
        public function getZipCode()
        {
                return $this->zipCode;
        }

        /**
         * Set the value of zipCode
         *
         * @return  self
         */ 
        public function setZipCode($zipCode)
        {
                $this->zipCode = $zipCode;

                return $this;
        }

        /**
         * Get the value of idState
         */ 
        public function getIdState()
        {
                return $this->idState;
        }

        /**
         * Set the value of idState
         *
         * @return  self
         */ 
        public function setIdState($idState)
        {
                $this->idState = $idState;

                return $this;
        }
    }
?>