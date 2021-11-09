<?php


namespace Kizi\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Kizi\Core\Social\Contracts\Provider driver(string $driver = null)
 * @see \Kizi\Core\Social\SocialManager
 */
class Social extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'social';
    }
}
