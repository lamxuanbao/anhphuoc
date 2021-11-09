<?php

namespace Kizi\Core\Models;

use Kizi\Core\Eloquent\Model;
use Kizi\Core\Entities\Traits\Translatable;

class Provinces extends Model
{
    use Translatable;

    public $translationModel = ProvinceTranslations::class;
    public $translationForeignKey = 'province_id';
    protected $translatedAttributes = ['name', 'type'];
    protected $with = ['translations'];
    protected $fillable = [
        'is_active',
        'is_default',
        'position',
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
}
