<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'price',
        'sessionsNumber',
        'gym_id',
    ];

    public function gym()
    {
        // return $this->belongsTo('App\User');
        return $this->belongsTo(Gym::class);
    }
}
