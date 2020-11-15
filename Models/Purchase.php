<?php 

namespace Models;

class Purchase
{
    private $idPurchase;
    private $qrCode;
    private $user;
    private $screening;
    private $order;

	public function getIdPurchase() {
		return $this->idPurchase;
	}

	public function setIdPurchase( $idPurchase) {
		$this->idPurchase = $idPurchase;
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