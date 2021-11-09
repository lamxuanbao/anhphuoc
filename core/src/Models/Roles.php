<?php

namespace Kizi\Core\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Kizi\Core\Eloquent\Model;
use Kizi\Core\Entities\Traits\Translatable;

/**
 * Class Roles.
 *
 * @package namespace App\Models;
 */
class Roles extends Model
{
    use Translatable;

    public $translationModel = RoleTranslations::class;
    public $translationForeignKey = 'role_id';
    protected $translatedAttributes = ['name'];
    protected $with = ['translations'];
    protected $fillable = [
        'is_active',
        'permissions',
    ];

    protected $casts = [
        'permissions' => AsArrayObject::class
    ];
}
