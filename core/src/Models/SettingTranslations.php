<?php

namespace Kizi\Core\Models;

use Kizi\Core\Eloquent\Model;

class SettingTranslations extends Model
{
    protected $fillable = ['value'];

    public function getValueAttribute($value)
    {
        return unserialize($value);
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = serialize($value);
    }

    public function usesTimestamps() : bool{
        return false;
    }
}
