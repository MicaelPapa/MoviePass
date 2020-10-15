<?php
	namespace Models;

	class MovieGenre
	{
		private $id;
		private $idIMDB;
		private $name;

		public function getId()
		{
			return $this->id;
		}
	
		public function setId($id)
		{
			$this->id = $id;
			return $this;
		}
		public function getIdIMDB()
		{
			return $this->idIMDB;
		}
	
		public function setIdIMDB($idIMDB)
		{
			$this->idIMDB = $idIMDB;
			return $this;
		}
	
		/**
		 * Getter for Name
		*
		* @return [type]
		*/
		public function getName()
		{
			return $this->name;
		}
	
		public function setName($name)
		{
			$this->name = $name;
			return $this;
		}
	}
?>