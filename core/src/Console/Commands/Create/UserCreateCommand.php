<?php

namespace Kizi\Core\Console\Commands\Create;


use Illuminate\Console\Command;
use Kizi\Core\Contracts\Repositories\UserRepository;

class UserCreateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a admin user';

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
        $email = $this->ask('Please enter a email to login');
        $password = bcrypt($this->secret('Please enter a password to login'));
        app(UserRepository::class)->create([
            'email' => $email,
            'password' => $password,
            'is_active' => true,
        ]);
    }

}
