<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Province;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(1)->create();
        $data = [
            'title' => 'Phước đát nhà xưởng',
            'address' => '20 đường 3/2 Phường 12 Quận 10 TP.Hồ Chí Minh, Việt Nam',
            'email' => 'phuocdnx@gmail.com',
            'hotline' => '0916226669',
            'filesystems_default' => 'public',
        ];
         Setting::setMany($data);

         $province = [
             [
                 'name' => 'Hồ chí minh'
             ],
             [
                 'name' => 'Long An'
             ],
             [
                 'name' => 'Bình Dương'
             ],
             [
                 'name' => 'Tây Ninh'
             ],
         ];
        Province::insert($province);
    }
}
