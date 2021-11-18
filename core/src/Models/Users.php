<?php

namespace Kizi\Core\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Kizi\Core\Eloquent\Model;

/**
 * Class Users.
 *
 * @package namespace App\Entities;
 */
class Users extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
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
        return [
            'kizi_tbl' => ''
        ];
        // TODO: Implement getJWTCustomClaims() method.
    }

    /**
     * The roles that belong to the roles.
     */
    public function roles()
    {
        return $this->belongsToMany(Roles::class,'user_roles','user_id','role_id');
    }

    public function scopeEmail($query, $email)
    {
        return $query->where('email', $email);
    }

}
