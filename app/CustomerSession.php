<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CustomerSession extends Pivot
{
    protected $fillable = [
        'session_id ',
        'customer_id',

    ];
    public function customer(){
        return $this->belongsTo(Customer::class);

    }

    public function session(){
        return $this->belongsTo(Session::class);

    }
   


}
