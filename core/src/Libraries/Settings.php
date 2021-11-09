<?php


namespace Kizi\Core\Libraries;


class Settings
{
    /**
     * Collection of all settings.
     *
     * @var \Illuminate\Support\Collection
     */
    private $settings;

    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Support\Collection $settings
     */
    public function __construct($settings)
    {
        $this->settings = $settings;
    }

    /**
     * Get all settings.
     *
     * @return array
     */
    public function all()
    {
        return $this->settings->all();
    }

    /**
     * Get setting for the given key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->settings->get($key) ?: $default;
    }

    /**
     * Set the given settings.
     *
     * @param array $settings
     * @return void
     */
    public function set($settings = [])
    {
        \Kizi\Core\Models\Settings::setMany($settings);
    }
}
