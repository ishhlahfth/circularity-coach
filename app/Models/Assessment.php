<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = 'freeassessment';

    protected $primaryKey = 'id';

    public $timestamp = false;
}
