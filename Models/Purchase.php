<?php 

namespace Models;

class Purchase
{
    private $idPurchase;
    private $subTotal;
    private $total;
    private $date;
    private $discount;
    private $user;
    private $screening;
    private $cantTickets;

    
    


    /**
     * Get the value of idPurchase
     */ 
    public function getIdPurchase()
    {
        return $this->idPurchase;
    }

    /**
     * Set the value of idPurchase
     *
     * @return  self
     */ 
    public function setIdPurchase($idPurchase)
    {
        $this->idPurchase = $idPurchase;

        return $this;
    }

    /**
     * Get the value of subTotal
     */ 
    public function getSubTotal()
    {
        return $this->subTotal;
    }

    /**
     * Set the value of subTotal
     *
     * @return  self
     */ 
    public function setSubTotal($subTotal)
    {
        $this->subTotal = $subTotal;

        return $this;
    }

    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     *
     * @return  self
     */ 
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of discount
     */ 
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set the value of discount
     *
     * @return  self
     */ 
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of screening
     */ 
    public function getScreening()
    {
        return $this->screening;
    }

    /**
     * Set the value of screening
     *
     * @return  self
     */ 
    public function setScreening($screening)
    {
        $this->screening = $screening;

        return $this;
    }

    /**
     * Get the value of cantTickets
     */ 
    public function getCantTickets()
    {
        return $this->cantTickets;
    }

    /**
     * Set the value of cantTickets
     *
     * @return  self
     */ 
    public function setCantTickets($cantTickets)
    {
        $this->cantTickets = $cantTickets;

        return $this;
    }
}






?>