<?php


namespace App\Models;


use App\Libraries\Helpers;
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
    protected $appends  = ['url'];

    function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function getUrlAttribute()
    {
        return Helpers::getFileUrl($this->path, $this->disk);
    }
}
