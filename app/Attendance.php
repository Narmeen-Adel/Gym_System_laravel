<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'session_id ',
        'customer_id',
    
    
    ];


    public function customers(){
        return $this->belongsTo(Customer::class);

    }

    // public function sessions(){
    //     return $this->belongsTo(Session::class);
    //     return $this->hasMany(Session::class)->using(CustomerSession::class)->withPivot('attendance_date');


    // }
   

}
