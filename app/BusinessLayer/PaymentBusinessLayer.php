<?php

namespace App\BusinessLayer;

use App\DTO\PaymentDTO;
use App\Helpers\Helpers;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Products;
use DateTime;
use Illuminate\Support\Facades\Crypt;
use \Stripe\StripeClient;
use Symfony\Component\ErrorHandler\ThrowableUtils;

class PaymentBusinessLayer extends GenericBusinessLayer
{
    public function generatePayment(PaymentDTO $params) {
        $result = null;
        $prefix = Helpers::generateDatePrefix();
        $reffcode = 'PAY'.$prefix;
        try {
        //INIT
        $stripe = new StripeClient(env('STRIPE_SECRET', ''));
        $cust = null;

        //INSERT CUSTOMER
        $newCust = false;
        $isExist = Customer::where('name', $params->getName())
                            ->where('email', $params->getEmail())
                            ->where('phone', $params->getWhatsapp())
                            ->first();
        if ( $isExist == null ) {
            $cust = Customer::create([
                'name' => $params->getName(),
                'phone' => $params->getWhatsapp(),
                'email' => $params->getEmail(),
                'whatsapp' => $params->getWhatsapp(),
            ]);
            $newCust = true;
        } else {
            $cust = $isExist;
        }
        $reffcode = $reffcode.$cust['id'];
        $encReffCode = Crypt::encryptString($reffcode);
        //GET PRODUCT
        $product = Products::find($params->getProductId());
        $price_id = $product->price_id;

        //GENERATE PAYMENT
        $paymentData = $stripe->checkout->sessions->create([
            'success_url' => env('APP_URL', '').'/api/success-payment?ref='.$encReffCode,
            'cancel_url' => 'https://www.circularity.coach',
            'line_items' => [
                [
                    'price' => $price_id,
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
        ]);
        $stripeSuccess = false;
        if($paymentData) {
            $stripeSuccess = true;
        }
        
        $payment = Payment::create([
            'ext_id' => $paymentData->id,
            'ref_code' => $reffcode,
            'customer_id' => $cust->id,
            'product_id' => $product->id,
            'ext_program_id' => $product->ext_id,
            'payment_url' => $paymentData->url,
            'total_amount' => $product->price,
        ]);
        $paymentSaved = false;
        if($payment) {
            $paymentSaved = true;
        }
        //WRAP EMAIL DETAIL
        $exp = new DateTime('@'.strval($paymentData->expires_at));
        $mailDetails = [
            'email' => $params->getEmail(),
            'name' => $params->getName(),
            'programName' => $product->title,
            'reffCode' => $reffcode,
            'amount' => $product->price,
            'expiredDate' => $exp->format('Y-m-d H:i:s'),
            'url' => $paymentData->url,
        ];
        //CUSTOMER PAYMENT MAIL SEND
        $paymentEmail = $this->mailSender('generate-payment', $mailDetails);
        //WRAP RESULT
        $result = [
            'newCust' => $newCust,
            'stripeSuccess' => $stripeSuccess,
            'paymentSaved' => $paymentSaved,
            'paymentEmail' => $paymentEmail,
        ];
        } catch (ThrowableUtils $e) {
            $result = $e;
        }
        return $result;
    }

    public function successPayment($encRefCode) {
        $isSuccess = false;
        try {
            $decodedRef = Crypt::decryptString($encRefCode);
            $checkData = Payment::where('ref_code', $decodedRef)->first();
            if($checkData) {
                $dt = new DateTime();
                $paidDate = $dt->format('Y-m-d H:i:s');
                $updateData = Payment::where('ref_code', $decodedRef)->update(['paid_date' => $paidDate]);
                if($updateData){
                    $custData = Customer::find($checkData->customer_id);
                    $product = Products::find($checkData->product_id);
                    $mailDetails = [
                        'name' => $custData->name,
                        'email' => $custData->email,
                        'phone' => $custData->phone,
                        'programName' => $product->title,
                        'reffCode' => $checkData->ref_code,
                        'amount' => $product->price,
                        'paidDate' => $paidDate,
                        'externalId' => $checkData->ext_id,
                    ];
                    $adminNotification = $this->mailSender('admin-notif-paid', $mailDetails);
                    $customerNotification = $this->mailSender('success-payment', $mailDetails);
                    $isSuccess = true;
                }
            }
        } catch (ThrowableUtils $e) {
            $isSuccess = false;
        }
        return $isSuccess;
    }

    public function invalidatePayment() {
        
    }

    public function test(PaymentDTO $params) {
        $newCust = false;
         $isExist = Customer::where('name', $params->getName())
                            ->where('email', $params->getEmail())
                            ->where('phone', $params->getWhatsapp())
                            ->first();
        if ( !$isExist ) {
            $cust = Customer::create([
                'name' => $params->getName(),
                'phone' => $params->getWhatsapp(),
                'email' => $params->getEmail(),
                'whatsapp' => $params->getWhatsapp(),
            ]);
            $newCust = true;
        } else {
            $cust = $isExist;
        }

        return $cust;
    }
}