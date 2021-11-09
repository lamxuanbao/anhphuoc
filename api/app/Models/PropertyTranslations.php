<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyTranslations extends Model
{
    protected $fillable = ['name','content'];

    public function usesTimestamps(): bool
    {
        return false;
    }
}
