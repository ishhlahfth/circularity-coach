<?php

namespace App\Http\Controllers\Web;

use App\BusinessLayer\PaymentBusinessLayer;
use App\DTO\PaymentDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    private $paymentBusinessLayer;

    public function __construct() {
        $this->paymentBusinessLayer = new PaymentBusinessLayer();
    }

    public function generatePayment(Request $request) {
        $params = new PaymentDTO();
        $params->setName($request->input('name'));
        $params->setEmail($request->input('email'));
        $params->setWhatsapp($request->input('whatsapp'));
        $params->setProductId($request->input('program_id'));
        $result = $this->paymentBusinessLayer->generatePayment($params);
        var_dump($result);
    }

    public function successPayment(Request $request) {
        $payment_ref = $request->input('ref');
        $result = $this->paymentBusinessLayer->successPayment($payment_ref);
        if($result) {
            return Redirect::to('https://www.circularity.coach/payment_success');
        } else {
            return Redirect::to('https://www.circularity.coach');
        }
    }
}
