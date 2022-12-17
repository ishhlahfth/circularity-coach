<?php

namespace App\Models;

use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $primaryKey = 'id';

    public $timestamp = false;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'whatsapp',
    ];

    public function getIncrementing(): bool {
        return false;
    }

    public static function boot() {
        parent::boot();
        self::creating(function($model) {
            $prefix = Helpers::generateDatePrefix();
            $model->customer_id = 'CUST' . $prefix . ($model::count() + 1);
        });
    }
}
