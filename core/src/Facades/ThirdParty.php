<?php


namespace Kizi\Core\Facades;

use Illuminate\Support\Facades\Facade;
use Kizi\Core\ThirdParty\SocialManager;

/**
 * @method static \Kizi\Core\ThirdParty\Contracts\Provider driver(string $driver = null)
 * @see \Kizi\Core\ThirdParty\SocialManager
 */
class ThirdParty extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'thirdParty';
    }
}
