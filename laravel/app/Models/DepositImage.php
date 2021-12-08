<?php


namespace App\Models;


use App\Libraries\Helpers;
use Illuminate\Database\Eloquent\Model;

class DepositImage extends Model
{
    protected $fillable = [
        'deposit_id',
        'disk',
        'name',
        'path',
        'extension',
        'mime',
        'size',
    ];
    protected $appends = ['url'];

    function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }

    public function getUrlAttribute()
    {
        return Helpers::getFileUrl($this->path, $this->disk);
    }
}
