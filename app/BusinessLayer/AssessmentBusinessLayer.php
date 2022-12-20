<?php

namespace App\BusinessLayer;

use App\DTO\AssessmentDTO;
use App\DTO\CustomerDTO;
use App\Models\Assessment;
use App\Models\Customer;
use Symfony\Component\ErrorHandler\ThrowableUtils;

class AssessmentBusinessLayer extends GenericBusinessLayer
{
    public function generateFreeAssessment(AssessmentDTO $params) {
        $result = null;
        try {
            //INIT
            $cust = null;

            //INSERT CUSTOMER
            $newCust = false;
            $isExist = Customer::where('name', $params->getName())
                            ->where('email', $params->getEmail())
                            ->where('phone', $params->getWhatsapp())
                            ->first();
            if ( $isExist == NULL ) {
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
            //GENERATE ASSESSMENT
            $assessment = Assessment::create([
                'customer_id' => $cust->id,
            ]);
            $mailDetails = [
                'email' => $params->getEmail(),
                'name' => $params->getName(),
                'phone' => $params->getWhatsapp(),
            ];
            //ADMIN NOTIF EMAIL
            $notifEmail = $this->mailSender('assessment-mail',$mailDetails);
            $result = [
                'assmentId' => $assessment->id,
                'notifSent' => $notifEmail,
            ];
        } catch (ThrowableUtils $e) {
            $result = $e;
        }
        return $result;
    }
}