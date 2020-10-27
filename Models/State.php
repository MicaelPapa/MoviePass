<?php 
namespace Models;


    class State{

        private $idState;
        private $stateName;
        private $country;

        

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

        /**
         * Get the value of stateName
         */ 
        public function getStateName()
        {
                return $this->stateName;
        }

        /**
         * Set the value of stateName
         *
         * @return  self
         */ 
        public function setStateName($stateName)
        {
                $this->stateName = $stateName;

                return $this;
        }

        /**
         * Get the value of idCountry
         */ 
        
         

        /**
         * Get the value of country
         */ 
        public function getCountry()
        {
                return $this->country;
        }

        /**
         * Set the value of country
         *
         * @return  self
         */ 
        public function setCountry($country)
        {
                $this->country = $country;

                return $this;
        }
    }

?>