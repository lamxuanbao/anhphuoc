<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customers extends \Kizi\Core\Eloquent\Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    protected $guard = 'driver';
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_active', 'email', 'password',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
        // TODO: Implement getJWTIdentifier() method.
    }

    public function getJWTCustomClaims()
    {
        return [];
        // TODO: Implement getJWTCustomClaims() method.
    }

    public function scopeEmail($query, $email)
    {
        return $query->where('email', $email);
    }

}