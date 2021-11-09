<?php

namespace Kizi\Core\Entities\Traits;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Config\Repository as ConfigContract;
use Illuminate\Contracts\Translation\Translator as TranslatorContract;

class Locales implements Arrayable, ArrayAccess
{
    /**
     * @var ConfigContract
     */
    protected $config;
    /**
     * @var TranslatorContract
     */
    protected $translator;
    /**
     * @var array
     */
    protected $locales = [];

    public function __construct(ConfigContract $config, TranslatorContract $translator)
    {
        $this->config = $config;
        $this->translator = $translator;
        $this->load();
    }

    public function load(): void
    {
        $this->locales = config('app.supported_locales') ?? [];
    }

    public function all(): array
    {
        return array_values($this->locales);
    }

    public function current()
    {
        return $this->translator->getLocale();
    }

    public function has(string $locale): bool
    {
        return true;
    }

    public function get(string $locale): ?string
    {
        return $this->locales[$locale] ?? null;
    }

    public function add(string $locale): void
    {
        $this->locales[$locale] = $locale;
    }

    public function forget(string $locale): void
    {
        unset($this->locales[$locale]);
    }

    public function getLocaleSeparator(): string
    {
        return '-';
    }

    public function getCountryLocale(string $locale, string $country): string
    {
        return $locale.$this->getLocaleSeparator().$country;
    }

    public function isLocaleCountryBased(string $locale): bool
    {
        return strpos($locale, $this->getLocaleSeparator()) !== false;
    }

    public function getLanguageFromCountryBasedLocale(string $locale): string
    {
        return explode($this->getLocaleSeparator(), $locale)[0];
    }

    public function toArray(): array
    {
        return $this->all();
    }

    public function offsetExists($key): bool
    {
        return $this->has($key);
    }

    public function offsetGet($key): ?string
    {
        return $this->get($key);
    }

    public function offsetSet($key, $value)
    {
        if (is_string($key) && is_string($value)) {
            $this->add($this->getCountryLocale($key, $value));
        } elseif (is_string($value)) {
            $this->add($value);
        }
    }

    public function offsetUnset($key)
    {
        $this->forget($key);
    }
}
