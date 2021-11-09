<?php
/**
 * Created by PhpStorm.
 * User: nhockizi
 * Date: 9/28/21
 * Time: 11:25
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Kizi\Core\Libraries\Helpers;

class PropertyImages extends Model
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
    protected $appends = ['url'];
    function property()
    {
        return $this->belongsTo(Properties::class);
    }
    public function getUrlAttribute()
    {
        return Helpers::getFileUrl($this->path, $this->disk);
    }
}
