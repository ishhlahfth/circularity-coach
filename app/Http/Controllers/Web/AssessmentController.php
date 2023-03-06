<?php

namespace App\Http\Controllers\Web;

use App\BusinessLayer\AssessmentBusinessLayer;
use App\DTO\AssessmentDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AssessmentController extends Controller
{
    private $assessmentBusinessLayer;

    public function __construct()
    {
        $this->assessmentBusinessLayer = new AssessmentBusinessLayer();
    }

    public function generateAssessment(Request $request)
    {
        $params = new AssessmentDTO();
        $params->setName($request->input('name'));
        $params->setEmail($request->input('email'));
        $params->setWhatsapp($request->input('phone'));
        $params->setSecret($request->input('secret'));
        if ($params->getSecret() == 29) {
            $result = $this->assessmentBusinessLayer->generateFreeAssessment($params);
            return Redirect::to('https://www.circularity.coach/assessment');
        } else {
            return Redirect::to('https://www.circularity.coach/error');
        }
    }
}
