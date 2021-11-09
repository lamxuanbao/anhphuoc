<?php

namespace Kizi\Core\Database;

use Illuminate\Database\Seeder;
use Kizi\Core\Models\Locale;

class LocalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filePath = __DIR__.'/file/locales.json';
        $file     = file_get_contents($filePath);
        $data     = json_decode($file, true);
        foreach ($data as $key => $value) {
            Locale::create($value);
        }
    }
}
