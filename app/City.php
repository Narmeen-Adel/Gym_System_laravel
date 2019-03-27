<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'city_manager_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User','city_manager_id');
    }
}
