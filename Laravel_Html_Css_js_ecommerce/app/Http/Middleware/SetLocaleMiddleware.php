<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = session('locale', 'it');
        App::setLocale($locale);
        
        return $next($request);
    }
}
