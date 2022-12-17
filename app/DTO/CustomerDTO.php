<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class CustomerDTO extends DataTransferObject
{
    private $customer_id;
	private $name;
	private $email;
	private $whatsapp;
    private $phone;
    

    public function getCustomerId() {
        return $this->customer_id;
    }
    public function setCustomerId($val) {
        $this->customer_id = $val;
        return $this;
    }
    public function getName() {
        return $this->name;
    }
    public function setName($val) {
        $this->name = $val;
        return $this;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($val) {
        $this->email = $val;
        return $this;
    }
    public function getWhatsapp() {
        return $this->whatsapp;
    }
    public function setWhatsapp($val) {
        $this->whatsapp = $val;
        return $this;
    }
    public function getPhone() {
        return $this->phone;
    }
    public function setPhone($val) {
        $this->phone = $val;
        return $this;
    }
}