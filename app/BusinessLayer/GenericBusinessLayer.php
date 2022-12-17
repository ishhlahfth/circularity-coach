<?php

namespace App\BusinessLayer;

use App\Mail\AdminNotification;
use App\Mail\AdminNotificationPaid;
use App\Mail\ExpiredNotification;
use App\Mail\GeneratePayment;
use App\Mail\SuccessPayment;
use Illuminate\Support\Facades\Mail;

class GenericBusinessLayer
{
    public function mailSender($type, $data) {
        $isSuccess = false;
        switch ($type) {
            case 'generate-payment':
                Mail::to($data['email'])->send(new GeneratePayment($data));
            break;
            case 'success-payment':
                Mail::to($data['email'])->send(new SuccessPayment($data));
            break;
            case 'admin-notif':
                Mail::to(env('ADMIN_EMAIL', ''))->send(new AdminNotification($data));
            break;
            case 'admin-notif-paid':
                Mail::to(env('ADMIN_EMAIL', ''))->send(new AdminNotificationPaid($data));
            break;
            case 'expired-notif':
                Mail::to($data['email'])->send(new ExpiredNotification($data));
            break;
        }
        if (count(Mail::failures()) < 1) {
            $isSuccess = true;
        }
        return $isSuccess;
    }
}