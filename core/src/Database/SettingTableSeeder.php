<?php

namespace Kizi\Core\Database;

use Illuminate\Database\Seeder;
use Kizi\Core\Models\Settings;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = require 'data/setting.php';
        Settings::setMany($data);
    }
}
