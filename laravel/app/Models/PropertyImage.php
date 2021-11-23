<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    protected $fillable = [
        'property_id',
        'disk',
        'name',
        'path',
        'extension',
        'mime',
        'size',
    ];
    function property()
    {
        return $this->belongsTo(Property::class);
    }
}
