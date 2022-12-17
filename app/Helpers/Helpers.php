<?php

namespace App\Helpers;

use DateTime;

class Helpers {
    
    public static function generateDatePrefix() {
        $dt = new DateTime();
        return $dt->format('ymdhis');
    }

}