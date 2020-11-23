<?php

	namespace Models;

    class Screening{
        
        private $idScreening;
        private $idMovieIMDB;
        private $startDate;
        private $lastDate;
        private $Dimension;
		private $Audio;
		private $Price;
        private $Subtitles;
        private $startHour;
		private $finishHour;
		private $remainTickets;
		private $room;
		private $cinema;
		private $movie;

	public function getIdScreening(){
		return $this->idScreening;
	}

	public function setIdScreening($idScreening) {
		$this->idScreening = $idScreening;
	}
	    
	public function getIdMovieIMDB() {
		return $this->idMovieIMDB;
	}

	public function setIdMovieIMDB($idMovieIMDB) {
		$this->idMovieIMDB = $idMovieIMDB;
	}

	public function getStartDate() {
		return $this->startDate;
	}

	public function setStartDate($startDate) {
		$this->startDate = $startDate;
	}

	public function getLastDate() {
		return $this->lastDate;
	}

	public function setLastDate($lastDate) {
		$this->lastDate = $lastDate;
	}

	public function getIdRoom() {
		return $this->idRoom;
	}

	public function setIdRoom($idRoom) {
		$this->idRoom = $idRoom;
	}

	public function getIdCinema() {
		return $this->idCinema;
	}

	public function setIdCinema($idCinema) {
		$this->idCinema = $idCinema;
	}

	public function getDimension() {
		return $this->Dimension;
	}

	public function setDimension($dimension) {
		$this->Dimension = $dimension;
	}

	public function getAudio() {
		return $this->Audio;
	}

	public function setAudio($audio) {
		$this->Audio = $audio;
	}

	public function getSubtitles() {
		return $this->Subtitles;
	}

	public function setSubtitles($subtitles) {
		$this->Subtitles = $subtitles;
	}

	public function getStartHour() {
		return $this->startHour;
	}

	public function setStartHour($startHour) {
		$this->startHour = $startHour;
	}

	public function getFinishHour() {
		return $this->finishHour;
	}

	public function setFinishHour($finishHour) {
		$this->finishHour = $finishHour;
	}

	public function getPrice() {
		return $this->Price;
	}

	public function setPrice($price) {
		$this->Price = $price;
	}

	public function getRemainTickets() {
		return $this->remainTickets;
	}

	public function setRemainTickets($remainTickets) {
		$this->remainTickets = $remainTickets;
	}

	public function getRoom()
	{
			return $this->room;
	}


	public function setRoom($room)
	{
		$this->room = $room;

		return $this;
	}

	public function getCinema()
	{
		return $this->cinema;
	}

	public function setCinema($cinema)
	{
		$this->cinema = $cinema;

		return $this;
	}

	public function getMovie()
	{
		return $this->movie;
	}

	public function setMovie($movie)
	{
		$this->movie = $movie;

		return $this;
	}
}
?>
