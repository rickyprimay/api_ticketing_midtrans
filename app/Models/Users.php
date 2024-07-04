<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Str;

class Users extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'users_id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'birth_date',
        'phone_number',
        'gender',
        'role',
        'is_verified',
        'otp',
        'otp_sent_at',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_sent_at' => 'datetime',
    ];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        // Generate UUID when creating a new user
        static::creating(function ($model) {
            if (empty($model->users_uuid)) {
                $model->users_uuid = (string) Str::uuid();
            }
        });
    }

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

    /**
     * Generate OTP with 6 digits.
     *
     * @return int
     */
    public static function generateOTP()
    {
        return mt_rand(100000, 999999);
    }
}
