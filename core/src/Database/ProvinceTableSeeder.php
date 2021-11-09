<?php

namespace Kizi\Core\Database;

use Illuminate\Database\Seeder;
use Kizi\Core\Models\Provinces;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provinces::truncate();
        $provinces = require 'data/province.php';
        foreach ($provinces as $key => $value) {
            $a = Provinces::create($value);
            $a->translate('en')->name = '123123';
            $a->save();
            dd($a);
        }
    }
}
