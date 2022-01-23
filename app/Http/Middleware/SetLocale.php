<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,  ...$locales)
    {
        $locales = $locales ?: ['ar', 'he', 'en'];

        if ($language = $request->getPreferredLanguage($locales)) {
            app()->setLocale($language);
        }

        return $next($request);
    }
}
