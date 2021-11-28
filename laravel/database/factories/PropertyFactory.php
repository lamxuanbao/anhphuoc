<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $number = rand(1,5555);
        return [
            'is_active' => true,
            'title' => 'bán nhà đường số '.$number,
            'description' => $this->faker->text(),
            'content' => 'Xưởng cho thuê trên đường 22/12 gần vòng xoay An Phú Thuận An Bình Dương.Diện tích: 2300m2 + 400m2 sàn lửng, có hệ thống PCCC và dòng điện 3 pha cho sản xuất hàng gỗ trắng và các ngành nghề khác.Giá 150 triệu/tháng.',
            'type' => 'buy',
            'price' => rand(1000,99999999),
            'area' => rand(1000,99999999),
            'address' => 'Đường '.$number.', Phường An Phú, Thuận An, Bình Dương',
            'province_id' => 1,
            'user_id' => 1,
        ];
    }
}
