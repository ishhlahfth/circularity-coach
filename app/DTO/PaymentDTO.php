<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class PaymentDTO extends DataTransferObject
{
	private $name;
	private $email;
	private $whatsapp;
	private $product_id;

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
    public function getProductId() {
        return $this->product_id;
    }
    public function setProductId($val) {
        $this->product_id = $val;
        return $this;
    }
}