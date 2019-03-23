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
}
