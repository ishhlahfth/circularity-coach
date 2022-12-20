<?php

namespace App\Http\Controllers\Web;

use App\BusinessLayer\AssessmentBusinessLayer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    private $assessmentBusinessLayer;

    public function __construct()
    {
        $this->assessmentBusinessLayer = new AssessmentBusinessLayer();   
    }


}
