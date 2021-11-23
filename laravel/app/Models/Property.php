<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
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
    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_id');
    }
    public function province()
    {
        return $this->hasOne(Province::class, 'id','province_id');
    }
}
