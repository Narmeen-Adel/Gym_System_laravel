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
        'gym',
        'package'
        
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
    
}
