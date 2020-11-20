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
      
        public function getIdUser()
        {
                return $this->idUser;
        }
        
        public function setIdUser()
        {
                $this->idUser = $idUser;

                return $this;
        }

        public function getEmail()
        {
                return $this->email;
        }
 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        public function getUserName()
        {
                return $this->userName;
        }

        public function setUserName($userName)
        {
                $this->userName = $userName;

                return $this;
        }
 
        public function getPassword()
        {
                return $this->password;
        }

        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        public function getGender()
        {
                return $this->gender;
        }

        public function setGender($gender)
        {
                $this->gender = $gender;

                return $this;
        }

        public function getBirthdate()
        {
                return $this->birthdate;
        }

        public function setBirthdate($birthdate)
        {
                $this->birthdate = $birthdate;

                return $this;
        }

        public function getIsAdmin()
        {
                return $this->isAdmin;
        }

        public function setIsAdmin($isAdmin)
        {
                $this->isAdmin = $isAdmin;

                return $this;
        }

        public function getChangedPassword()
        {
                return $this->changedPassword;
        }

        public function setChangedPassword($changedPassword)
        {
                $this->changedPassword = $changedPassword;

                return $this;
        }

        public function getPhoto()
        {
                return $this->photo;
        }

        public function setPhoto($photo)
        {
                $this->photo = $photo;

                return $this;
        }
   }
   ?>
