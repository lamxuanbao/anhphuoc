<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Kizi\Core\Libraries\Helpers;

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

    public static function setMany($settings)
    {
        foreach ($settings as $key => $value) {
            self::set($key, $value);
        }
    }

    public static function set($key, $value)
    {
        $file = ['logo', 'favicon'];
        if (in_array($key, $file)) {
            try {
                if (!is_string($value) && $value->isValid()) {
                    $file = \App\Libraries\Helpers::uploadFile($value, 'settings');
                    unset($file['url']);
                    static::updateOrCreate(['key' => $key], ['value' => serialize($file)]);
                }
            } catch (\Exception $e) {
            }
        } else {
            static::updateOrCreate(['key' => $key], ['value' => serialize($value)]);
        }
    }

    public function getValueAttribute()
    {
        return unserialize($this->attributes['value']);
    }
}
