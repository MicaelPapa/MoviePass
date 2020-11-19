<?php 

namespace Models;

class Ticket
{
    private $idTicket;
    private $qrCode;
    private $user;
    private $screening;
    private $order;

	public function getIdTicket() {
		return $this->idTicket;
	}

	public function setIdTicket( $idTicket) {
		$this->idTicket = $idTicket;
	}

	public function getQrCode() {
		return $this->qrCode;
	}

	public function setQrCode( $qrCode) {
		$this->qrCode = $qrCode;
	}

	public function getUser() {
		return $this->user;
	}

	public function setUser( $user) {
		$this->user = $user;
	}

	public function getScreening() {
		return $this->screening;
	}

	public function setScreening ($screening) {
		$this->screening = $screening;
	}

	public function getOrder() {
		return $this->order;
	}

	public function setOrder( $order) {
		$this->order = $order;
	}

    

}






?>