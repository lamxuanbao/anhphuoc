<?php


namespace Kizi\Core\ThirdParty;


use Illuminate\Support\Manager;
use Kizi\Core\ThirdParty\Services\Ecommerce\Shopify;
use Kizi\Core\ThirdParty\Services\Social\Facebook;

class ThirdPartyManager extends Manager
{
    public function getDefaultDriver()
    {
        throw new \InvalidArgumentException('No Thirdparty driver was specified.');
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

    protected function createShopifyDriver()
    {
        return new Shopify();
    }
}
