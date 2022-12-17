<?php

namespace App\Models;

use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    
    protected $fillable = [
        'ext_id',
        'ref_code',
        'customer_id',
        'product_id',
        'ext_program_id',
        'payment_url',
        'expired_date',
        'total_amount',
        'paid_date',
    ];

    protected $primaryKey = 'id';

    public $timestamp = true;

}
