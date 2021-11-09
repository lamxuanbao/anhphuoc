<?php

namespace Kizi\Core\Models;

use Kizi\Core\Eloquent\Model;


class WardTranslations extends Model
{
    protected $fillable = ['name', 'type'];

    public function usesTimestamps() : bool{
        return false;
    }
}
