<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    protected $fillable = [
        'name',
        'city_id',
        'cover_image',
        'user_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
