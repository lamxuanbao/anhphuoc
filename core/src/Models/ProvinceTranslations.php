<?php

namespace Kizi\Core\Models;

use Kizi\Core\Eloquent\Model;


class ProvinceTranslations extends Model
{
    protected $fillable = ['name', 'type'];

    public function usesTimestamps() : bool{
        return false;
    }
}
