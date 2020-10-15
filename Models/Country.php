<?php 
namespace Models;


    class Country{

        private $idCountry;
        private $countryName;
        private $countryCode;

        

        /**
         * Get the value of idCountry
         */ 
        public function getIdCountry()
        {
                return $this->idCountry;
        }

        /**
         * Set the value of idCountry
         *
         * @return  self
         */ 
        public function setIdCountry($idCountry)
        {
                $this->idCountry = $idCountry;

                return $this;
        }

        /**
         * Get the value of CountryName
         */ 
        public function getCountryName()
        {
                return $this->countryName;
        }

        /**
         * Set the value of CountryName
         *
         * @return  self
         */ 
        public function setCountryName($countryName)
        {
                $this->countryName = $countryName;

                return $this;
        }


        /**
         * Get the value of countryCode
         */ 
        public function getCountryCode()
        {
                return $this->countryCode;
        }

        /**
         * Set the value of countryCode
         *
         * @return  self
         */ 
        public function setCountryCode($countryCode)
        {
                $this->countryCode = $countryCode;

                return $this;
        }
    }

?>