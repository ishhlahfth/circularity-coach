<?php

namespace App\BusinessLayer;

use App\DTO\CustomerDTO;
use App\Models\Customer;

class CustomerBusinessLayer extends GenericBusinessLayer
{
    public function insertNewCustomer(CustomerDTO $params)
    {
        $isExist = Customer::where('name', $params->name)
            ->where('email', $params->email)
            ->where('phone', $params->phone)
            ->get();
        if (!$isExist) {
            $cust = Customer::create([
                'name' => $params->name,
                'phone' => $params->phone,
                'email' => $params->email,
                'whatsapp' => $params->whatsapp,
            ]);
        } else {
            $cust = $isExist;
        }
        return $cust;
    }
    public function getAllCustomer()
    {
        $data = Customer::all();
        return $data;
    }
}
