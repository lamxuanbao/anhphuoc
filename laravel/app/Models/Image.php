<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'disk',
        'name',
        'path',
        'extension',
        'mime',
        'size',
    ];
}
