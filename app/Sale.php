<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'paid_price','available_sessions','package_id','user_id'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function user(){
        return $this->belongsTo(User::class);

    }

}
