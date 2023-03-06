<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class AssessmentDTO extends DataTransferObject
{
    private $name;
    private $email;
    private $whatsapp;
    private $secret;

    public function getName()
    {
        return $this->name;
    }
    public function setName($val)
    {
        $this->name = $val;
        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($val)
    {
        $this->email = $val;
        return $this;
    }
    public function getWhatsapp()
    {
        return $this->whatsapp;
    }
    public function setWhatsapp($val)
    {
        $this->whatsapp = $val;
        return $this;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function setSecret($val)
    {
        $this->secret = $val;
        return $this;
    }
}
