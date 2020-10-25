<?php

namespace Interfaces;

interface IAddressDAO
{
    public function GetAll();
    public function getAddressByCity($idCity);
    public function getAddressById($idAddress);
    public function add($address);
    public function getIdFromDataBase($street, $numberStreet);
}
