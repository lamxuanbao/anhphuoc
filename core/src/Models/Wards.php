<?php

namespace Kizi\Core\Models;

use Kizi\Core\Eloquent\Model;
use Kizi\Core\Entities\Traits\Translatable;

class Wards extends Model
{
    use Translatable;

    public $translationModel = WardTranslations::class;
    public $translationForeignKey = 'ward_id';
    protected $translatedAttributes = ['name', 'type'];
    protected $with = ['translations'];
    protected $fillable = [
        'is_active',
        'is_default',
        'position',
        'province_id',
        'district_id',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];

    protected $appends = ['display_name'];

    public function getDisplayNameAttribute()
    {
        switch ($this->locale()) {
            case 'vi':
                $displayName = $this->type.' '.$this->name;
                break;
            default:
                $displayName = $this->name.' '.$this->type;
                break;
        }
        return $displayName;
    }

    public function province()
    {
        return $this->hasOne(Provinces::class, 'id', 'province_id');
    }

    public function district()
    {
        return $this->hasOne(Districts::class, 'id', 'district_id');
    }
}
