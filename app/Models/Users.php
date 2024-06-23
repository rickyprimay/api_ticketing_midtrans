<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable implements JWTSubject

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
    ];

    protected $hidden = [
        'password',
        'remember_token',
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
}
