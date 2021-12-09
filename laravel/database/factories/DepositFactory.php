<?php

namespace Database\Factories;

use App\Models\Deposit;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepositFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Deposit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $number = rand(1,5555);
        return [
            'title' => 'bán nhà đường số '.$number,
            'content' => 'Xưởng cho thuê trên đường 22/12 gần vòng xoay An Phú Thuận An Bình Dương.Diện tích: 2300m2 + 400m2 sàn lửng, có hệ thống PCCC và dòng điện 3 pha cho sản xuất hàng gỗ trắng và các ngành nghề khác.Giá 150 triệu/tháng.',
        ];
    }
}
