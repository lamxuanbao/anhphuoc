<?php


namespace Kizi\Core\Social;


use Illuminate\Support\Manager;
use Kizi\Core\Social\Services\Facebook;

class SocialManager extends Manager
{
    public function getDefaultDriver()
    {
        throw new \InvalidArgumentException('No Social driver was specified.');
    }

    /**
     * Get a driver instance.
     *
     * @param  string  $driver
     * @return mixed
     */
    public function with($driver)
    {
        return $this->driver($driver);
    }

    protected function createFacebookDriver()
    {
        return new Facebook();
    }
}
