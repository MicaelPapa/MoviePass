<?php 

  namespace Models;

  Class Order
  {
    private $idOrder;
    private $subTotal;
    private $total;
    private $datePurchase;
    private $discount;
    private $cantTickets;

	 public function getIdOrder() {
		return $this->idOrder;
	}

	 public function setIdOrder( $idOrder) {
		$this->idOrder = $idOrder;
	}

	 public function getSubTotal() {
		return $this->subTotal;
	}

	 public function setSubTotal( $subTotal) {
		$this->subTotal = $subTotal;
	}

	 public function getTotal() {
		return $this->total;
	}

	 public function setTotal( $total) {
		$this->total = $total;
	}

	 public function getDatePurchase() {
		return $this->datePurchase;
	}

	 public function setDatePurchase( $datePurchase) {
		$this->datePurchase = $datePurchase;
	}

	 public function getDiscount() {
		return $this->discount;
	}

	 public function setDiscount( $discount) {
		$this->discount = $discount;
	}

	 public function getCantTickets() {
		return $this->cantTickets;
	}

	 public function setCantTickets( $cantTickets) {
		$this->cantTickets = $cantTickets;
	}
  }

?>