<?php

namespace Kizi\Core\Database;

use Illuminate\Database\Seeder;
use Kizi\Core\Contracts\Repositories\RoleRepository;
use Kizi\Core\Models\Settings;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = require 'data/role.php';
        app(RoleRepository::class)->create($data);
    }
}
