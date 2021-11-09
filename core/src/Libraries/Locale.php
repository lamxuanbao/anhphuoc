<?php


namespace Kizi\Core\Libraries;


class Locale
{
    /**
     * Collection of all locales.
     *
     * @var \Illuminate\Support\Collection
     */
    private $locales;

    /**
     * Create a new repository instance.
     *
     * @param  \Illuminate\Support\Collection  $locales
     */
    public function __construct($locales)
    {
        $this->locales = $locales;
    }

    /**
     * Get all locales.
     *
     * @return array
     */
    public function all()
    {
        return $this->locales->all();
    }

    /**
     * Get setting for the given key.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->locales->get($key) ?: $default;
    }
}
