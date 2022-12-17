<?php

namespace App\Models;

use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id';

    public $timestamp = true;

    public function getIncrementing(): bool {
        return false;
    }

    public static function boot() {
        parent::boot();
        self::creating(function($model) {
            $prefix = Helpers::generateDatePrefix();
            $model->product_id = 'PRD' . $prefix . ($model::count() + 1);
        });
    }
}
