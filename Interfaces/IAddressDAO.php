<?php

namespace Interfaces;

interface IAddressDAO
{
    public function GetAll();
    public function getAddressById($idAddress);
    public function add($address);
}
