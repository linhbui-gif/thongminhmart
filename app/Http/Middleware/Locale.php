<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Session;
use Illuminate\Foundation\Application;
use Request;
class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $language = Session::get('website_language', config('app.locale'));
        app()->setLocale($language);
        return $next($request);
    }
}
