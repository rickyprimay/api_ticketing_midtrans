<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable implements JWTSubject, MustVerifyEmail

{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'users_id';
    
    protected $fillable = [
        'users_id',
        'name',
        'email',
        'password',
        'birth_date',
        'phone_number',
        'gender',
        'role',
        'is_verified'
    ];

    protected $hidden = [
        'password',
    ];

    public function tickets()
    {
        return $this->hasMany(Tickets::class, 'users_id', 'users_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Generate OTP with 6 digits.
     *
     * @return int
     */
    public static function generateOTP()
    {
        // Generate random 6-digit OTP
        $otp = mt_rand(100000, 999999);

        return $otp;
    }
}
