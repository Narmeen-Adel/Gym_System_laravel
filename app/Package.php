<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name',
        'sessionsNumber',
        'price',
        'gym_id',
    ];

    public function gym()
    {

        return $this->belongsTo('App\Gym');
    }


    public function customers()
    {
        return $this->belongsToMany('App\Customer')->using(Sales::class)->withPivot('paid_price ,available_sessions');
    }

    public function getPackagePrice($cents)
    {
        $inDollar=$cents /100;
        return $inDollar;
    }
     
    public function setPackagePrice($dollars)
    {
        $this->attributes['price'] = $dollars * 100;
    }
}
