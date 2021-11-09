<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kizi\Core\Entities\Traits\Translatable;

class Properties extends Model
{
    use Translatable;

    public $translationModel = PropertyTranslations::class;
    public $translationForeignKey = 'property_id';
    protected $translatedAttributes = ['name', 'content'];
    protected $with = ['translations'];
    protected $fillable = [
        'is_active',
        'type',
        'price',
        'area',
        'province_id',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function images()
    {
        return $this->hasMany(PropertyImages::class,'property_id');
    }
}
