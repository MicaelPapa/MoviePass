<?php
namespace Models;

class Address
{
        private $idAddress;
        private $street;
        private $numberStreet;
        private $department;
        private $departmentFloor;
        private $idCity;


      


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
         * Get the value of idAddress
         */ 
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
}
