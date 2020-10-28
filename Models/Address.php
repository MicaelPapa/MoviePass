<?php

namespace Models;

class Address
{
        private $idAddress;
        private $street;
        private $numberStreet;
        private $department;
        private $departmentFloor;
        private $city;



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

        /**
         * Get the value of department
         */
        public function getDepartment()
        {
                return $this->department;
        }

        /**
         * Set the value of department
         *
         * @return  self
         */
        public function setDepartment($department)
        {
                $this->department = $department;

                return $this;
        }

        /**
         * Get the value of departmentFloor
         */
        public function getDepartmentFloor()
        {
                return $this->departmentFloor;
        }

        /**
         * Set the value of departmentFloor
         *
         * @return  self
         */
        public function setDepartmentFloor($departmentFloor)
        {
                $this->departmentFloor = $departmentFloor;

                return $this;
        }


        /**
         * Get the value of idAddress
         */

        /**
         * Get the value of city
         */
        public function getCity()
        {
                return $this->city;
        }

        /**
         * Set the value of city
         *
         * @return  self
         */
        public function setCity($city)
        {
                $this->city = $city;

                return $this;
        }
}
