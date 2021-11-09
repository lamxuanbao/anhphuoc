<?php

namespace Kizi\Core\Eloquent;


use Illuminate\Support\Facades\Cache;

abstract class Model extends \Illuminate\Database\Eloquent\Model
{

    protected $hidden = [
        'deleted_at',
        'translations',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
    }

    /**
     * Register a new active global scope on the model.
     *
     * @return void
     */
    public static function addActiveGlobalScope()
    {
        static::addGlobalScope('active', function ($query) {
            $query->where('is_active', true);
        });
    }

    public function scopeFindOrCreate($query, $id)
    {
        $obj = $query->find($id);
        return $obj ?: new static;
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public function relations()
    {
        return collect($this->with ?? [])
            ->mapWithKeys(function ($relation) {
                return [
                    $relation => function ($query) {
                        return $query->withoutGlobalScope('active');
                    }
                ];
            })
            ->all();
    }

    /**
     * Cast an attribute to a native PHP type.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return null;
        }
        if ($this->getCastType($key) == 'array') {
            return [];
        }

        return parent::castAttribute($key, $value);
    }
}
