<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'paid_price','available_sessions','package_id','customer_id'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function customer(){
        return $this->belongsTo(User::class);

    }

}
