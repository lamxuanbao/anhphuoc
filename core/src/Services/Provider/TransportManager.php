<?php

namespace Kizi\Core\Services\Provider;

use Illuminate\Mail\MailManager;

class TransportManager extends MailManager
{

    /**
     * Create a new manager instance.
     *
     * @param  \Illuminate\Support\ServiceProvider  $app
     * @return void
     */
    public function __construct($app)
    {
        $this->config = $app->make('config');
        $this->config['mail'] = [
            'driver' => setting('mail_driver', env('MAIL_DRIVER')),
            'host' => setting('mail_host', env('MAIL_HOST')),
            'port' => setting('mail_port', env('MAIL_PORT')),
            'from' => [
                'address' => setting('mail_from_address'),
                'name' => setting('mail_from_name')
            ],
            'encryption' => setting('mail_encryption', env('MAIL_ENCRYPTION')),
            'username' => setting('mail_username', env('MAIL_USERNAME')),
            'password' => setting('mail_password', env('MAIL_PASSWORD')),
        ];
    }
}
