<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $table = 'inboxes';

    protected $primaryKey = 'id';

    public $timestamp = true;
}
