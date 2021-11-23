<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function allCached()
    {
        if (!config('app.cache')) {
            return static::all()->pluck('value', 'key');
        }

        return Cache::rememberForever('settings.all', function () {
            return static::all()->pluck('value', 'key');
        });
    }
}
