<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kizi\Core\Entities\Traits\Sluggable;
use Kizi\Core\Entities\Traits\Translatable;
use Kizi\Core\Models\Provinces;

class Properties extends Model
{
    use Translatable, Sluggable;

    protected $slugAttribute = 'name';
    public $translationModel = PropertyTranslations::class;
    public $translationForeignKey = 'property_id';
    protected $translatedAttributes = ['name', 'content', 'keywords', 'description','address'];
    protected $with = ['translations','province','images'];
    protected $fillable = [
        'is_active',
        'type',
        'price',
        'area',
        'address',
        'province_id',
        'user_id',
        'slug',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();
        static::saving(function (Model $model) {
            try {
                if (is_null($model->slug)) {
                    $model->setSlug();
                }
            } catch (\Exception $e) {

            }
            return $model;
        });
    }

    public function images()
    {
        return $this->hasMany(PropertyImages::class, 'property_id');
    }
    public function province()
    {
        return $this->hasOne(Provinces::class, 'id','province_id');
    }
}
