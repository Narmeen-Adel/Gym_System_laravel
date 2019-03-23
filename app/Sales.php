<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
class Sales extends Pivot
{
    protected $fillable = [
        'paid_price ',
        'available_sessions',
        'created_at',
        'package_id',
        'user_id '
    ];

    // public function package()
    // {
    //     return $this->hasMany('App\Package');
    // }

    // public function user()
    // {
    //     return $this->hasMany('App\User');
    // }

}
