<?php

namespace Kizi\Core\Http\Middleware;

use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $this->parseLocale($request);
        return $next($request);
    }


    protected function parseLocale($request)
    {
        config([
            'app.fallback_locale' => setting('default_locale'),
        ]);
        $locale  = $request->server('HTTP_ACCEPT_LANGUAGE');
        if (is_null($locale)) {
            $locale = setting('default_locale');
        } else {
            $locale = substr($locale, 0, strpos($locale, ',') ?: strlen($locale));
        }

        app()->setLocale($locale);
    }
}
