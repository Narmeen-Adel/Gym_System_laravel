<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
class Customer extends Authenticatable implements JWTSubject ,MustVerifyEmail

{
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password','gender','confirm_password','date_of_birth','image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//////////////////////// for jwt authintication

public function getJWTIdentifier()
{
    return $this->getKey();
}

/**
 * Return a key value array, containing any custom claims to be added to the JWT.
 *
 * @return array
 */
public function getJWTCustomClaims()
{
    return [];
}


    public function sessions()
    {
        return $this->belongsToMany(Session::class)->using(CustomerSession::class)->withPivot('attendance_date');
    }


    public function verifyCustomer()
    {
        return $this->hasOne('App\VerifyCustomer');
    }
}
