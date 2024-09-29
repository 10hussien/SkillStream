<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class SetAppLang
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->lang ? $request->lang : 'en';
        app()->setlocale($locale);
        return $next($request);
    }
}
