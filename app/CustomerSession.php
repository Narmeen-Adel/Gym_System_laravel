<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CustomerSession extends Pivot
{
    protected $fillable = [
        'session_id ',
        'customer_id',
        // 'created_at',

    ];


}
