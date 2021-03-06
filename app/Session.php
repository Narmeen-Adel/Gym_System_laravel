<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $dates = [
        'starts_at',
        'finishes_at'
    ];
    protected $fillable = [
        'name',
        'starts_at',
        'finishes_at',
        'day',
        'coaches',
        'gym_id',
        'package_id',

    ];

    public function coaches(){
        return $this->belongsToMany(Coach::class);

    }
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class)->using(CustomerSession::class)->withPivot('attendance_date');
    }

}
