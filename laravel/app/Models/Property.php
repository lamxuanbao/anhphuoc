<?php


namespace App\Models;


use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use Sluggable, HasFactory;
    protected $fillable = [
        'is_active',
        'title',
        'description',
        'keyword',
        'content',
        'type',
        'price',
        'area',
        'address',
        'province_id',
        'user_id',
        'customer_id',
        'slug',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $slugAttribute = 'title';

    public static function boot()
    {
        parent::boot();
        static::saving(
            function (Model $model) {
                try {
                    if (is_null($model->slug)) {
                        $model->setSlug();
                    }
                } catch (\Exception $e) {

                }

                return $model;
            }
        );
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_id');
    }

    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
