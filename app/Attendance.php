<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'session_id ',
        'user_id',
        'created_at ',
    ];

}
