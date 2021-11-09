<?php

namespace Kizi\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Kizi\Core\Contracts\Repositories\RoleRepository;
use Kizi\Core\Models\Settings;

class CoreInstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'core:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the core package';

    /**
     * Install directory.
     *
     * @var string
     */
    protected $directory = '';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->initDatabase();
        $this->initArtisan();
    }

    protected function initArtisan(){
        Artisan::call('jwt:secret');
    }
    /**
     * Create tables and seed it.
     *
     * @return void
     */
    protected function initDatabase()
    {
        $this->call('migrate:refresh');
        $this->runSeeder();
        $this->call('create:user');
    }

    private function runSeeder()
    {
        $settings = require __DIR__.'/../../Database/data/setting.php';
        Settings::setMany($settings);

        $roles = require __DIR__.'/../../Database/data/role.php';
        app(RoleRepository::class)->create($roles);

        Artisan::call('core:generate-province');
    }
}
