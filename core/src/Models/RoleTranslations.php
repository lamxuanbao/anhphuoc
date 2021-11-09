<?php

namespace Kizi\Core\Models;

use Kizi\Core\Eloquent\Model;


class RoleTranslations extends Model
{
    protected $fillable = ['name'];

    public function usesTimestamps() : bool{
        return false;
    }
}
