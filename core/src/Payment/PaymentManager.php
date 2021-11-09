<?php

namespace Kizi\Core\Payment;

use Illuminate\Support\Manager;
use Kizi\Core\Payment\Services\OnePay;

class PaymentManager extends Manager
{
    public function getDefaultDriver()
    {
        throw new \InvalidArgumentException('No Platform driver was specified.');
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
    protected function createOnepayDriver()
    {
        return app(OnePay::class);
    }
}
