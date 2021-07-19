<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Localization
{

    public function handle($request, Closure $next)
    {
        $locale = ($request->hasHeader('Content-Language')) ? $request->header('Content-Language') : 'en';
		if (! in_array($locale, ['en', 'mm'])) {
            abort(400);
        }
        App::setLocale($locale);
        return $next($request);
    }
}
