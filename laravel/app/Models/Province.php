<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'is_active',
        'is_default',
        'position',
        'type',
        'name'
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];
}
