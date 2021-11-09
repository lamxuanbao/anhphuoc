<?php


namespace Kizi\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Kizi\Core\Contracts\Payment driver(string $driver = null)
 * @see \Kizi\Core\Social\SocialManager
 */
class Payment extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'payment';
    }
}
