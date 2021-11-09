<?php

namespace Kizi\Core\Models;

use Kizi\Core\Eloquent\Model;
use Kizi\Core\Entities\Traits\Translatable;
use Kizi\Core\Libraries\Helpers;

class Settings extends Model
{
    use Translatable;

    public $translationModel = SettingTranslations::class;
    public $translationForeignKey = 'setting_id';
    protected $translatedAttributes = ['value'];
    protected $with = ['translations'];
    protected $fillable = [
        'key',
        'is_translatable',
        'plain_value'
    ];
    protected $casts = [
        'is_translatable' => 'boolean',
    ];

    public static function allCached()
    {
        return self::all()
            ->mapWithKeys(function ($setting) {
                $file = config('settings.fields.file') ?? [];
                $value = $setting->value;
                if (in_array($setting->key, $file)) {
                    $value['url'] = Helpers::getFileUrl($value['path'], $value['disk']);
                }
                return [$setting->key => $value];
            });
    }

    public static function has($key)
    {
        return static::where('key', $key)
            ->exists();
    }

    public static function get($key, $default = null)
    {
        return static::where('key', $key)
                ->first()->value ?? $default;
    }

    public static function set($key, $value)
    {
        if ($key === 'translations') {
            return static::setTranslatableSettings($value);
        }
        $file = config('settings.fields.file') ?? [];
        if (in_array($key, $file)) {
            try {
                if (!is_string($value) && $value->isValid()) {
                    $file = Helpers::uploadFile($value, 'settings');
                    unset($file['url']);
                    static::updateOrCreate(['key' => $key], ['plain_value' => $file]);
                }
            } catch (\Exception $e) {
            }
        } else {
            static::updateOrCreate(['key' => $key], ['plain_value' => $value]);
        }
    }

    public static function setMany($settings)
    {
        foreach ($settings as $key => $value) {
            self::set($key, $value);
        }
    }

    public static function setTranslatableSettings($settings = [])
    {
        foreach ($settings as $locale => $item) {
            foreach ($item as $key => $value) {
                $model = static::updateOrCreate(['key' => $key], [
                    'is_translatable' => true,
                ]);
                $model->getTranslationOrNew($locale)
                    ->fill(['value' => $value]);
                $model->save();
            }
        }
    }

    public function getValueAttribute()
    {
        if ($this->is_translatable) {
            return $this->translateOrDefault(locale())->value ?? null;
        }
        return unserialize($this->plain_value);
    }

    public function setPlainValueAttribute($value)
    {
        $this->attributes['plain_value'] = serialize($value);
    }

    public function usesTimestamps(): bool
    {
        return false;
    }
}
