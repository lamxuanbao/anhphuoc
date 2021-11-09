<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Kizi\Core\Database\ProvinceTableSeeder;
use Kizi\Core\Database\SettingTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                SettingTableSeeder::class,
//                ProvinceTableSeeder::class,
            ]
        );
    }
}
