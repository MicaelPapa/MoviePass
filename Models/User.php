<?php
namespace Models;

class User
{
        private $idUser;
        private $email;
        private $userName;
        private $password;
        private $birthdate;
        private $gender;
        private $isAdmin;
        private $changedPassword;
        private $photo;

        public function __construct($email, $userName, $password, $birthdate, $gender, $photo)
        {       
                $this->email = $email;
                $this->userName = $userName;
                $this->password = $password;
                $this->birthdate = $birthdate;
                $this->gender = $gender;
                $this->photo = $photo;
        }
      
        public function getIdUser()
        {
                return $this->idUser;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getUserName()
        {
                return $this->userName;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUserName($userName)
        {
                $this->userName = $userName;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of gender
         */ 
        public function getGender()
        {
                return $this->gender;
        }

        /**
         * Set the value of gender
         *
         * @return  self
         */ 
        public function setGender($gender)
        {
                $this->gender = $gender;

                return $this;
        }

        /**
         * Get the value of birthdate
         */ 
        public function getBirthdate()
        {
                return $this->birthdate;
        }

         /**
         * Set the value of birthdate
         *
         * @return  self
         */ 
        public function setBirthdate($birthdate)
        {
                $this->birthdate = $birthdate;

                return $this;
        }

        /**
         * Get the value of isAdmin
         */ 
        public function getIsAdmin()
        {
                return $this->isAdmin;
        }

        /**
         * Set the value of isAdmin
         *
         * @return  self
         */ 
        public function setIsAdmin($isAdmin)
        {
                $this->isAdmin = $isAdmin;

                return $this;
        }

        /**
         * Get the value of changedPassword
         */ 
        public function getChangedPassword()
        {
                return $this->changedPassword;
        }

        /**
         * Set the value of changedPassword
         *
         * @return  self
         */ 
        public function setChangedPassword($changedPassword)
        {
                $this->changedPassword = $changedPassword;

                return $this;
        }

        /**
         * Get the value of photo
         */ 
        public function getPhoto()
        {
                return $this->photo;
        }

        /**
         * Set the value of photo
         *
         * @return  self
         */ 
        public function setPhoto($photo)
        {
                $this->photo = $photo;

                return $this;
        }
}
