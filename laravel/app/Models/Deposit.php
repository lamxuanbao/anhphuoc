<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'status',
    ];

    public function images()
    {
        return $this->hasMany(DepositImage::class, 'deposit_id');
    }
}
