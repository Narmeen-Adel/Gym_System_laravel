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
        
    ];

    public function coaches(){
        return $this->belongsToMany(Coach::class);
                    
    }
    
}
