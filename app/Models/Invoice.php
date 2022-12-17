<?php

namespace App\Models;

use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';

    protected $primaryKey = 'id';

    public $timestamp = true;

    public function getIncrementing(): bool {
        return false;
    }

    public static function boot() {
        parent::boot();
        self::creating(function($model) {
            $prefix = Helpers::generateDatePrefix();
            $model->ref_code = 'INV' . $prefix . ($model::count() + 1);
        });
    }
}
