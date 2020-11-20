<?php

namespace Models;

class Address
{
        private $idAddress;
        private $street;
        private $numberStreet;
       

        public function getIdAddress()
        {
                return $this->idAddress;
        }

        /**
         * Set the value of idAddress
         *
         * @return  self
         */
        public function setIdAddress($idAddress)
        {
                $this->idAddress = $idAddress;

                return $this;
        }


        /**
         * Get the value of street
         */
        public function getStreet()
        {
                return $this->street;
        }

        /**
         * Set the value of street
         *
         * @return  self
         */
        public function setStreet($street)
        {
                $this->street = $street;

                return $this;
        }

        /**
         * Get the value of numberStreet
         */
        public function getNumberStreet()
        {
                return $this->numberStreet;
        }

        /**
         * Set the value of numberStreet
         *
         * @return  self
         */
        public function setNumberStreet($numberStreet)
        {
                $this->numberStreet = $numberStreet;

                return $this;
        }

    
}
