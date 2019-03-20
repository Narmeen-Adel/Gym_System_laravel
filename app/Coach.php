<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $fillable = [
        'name',
    ];

    public function sesssions(){
        return $this->belongsToMany(Session::class);
    }
}
