<?php

namespace App\Http\Middleware;

use App\utils\translate;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Owner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role != 'owner') {
            return response()->json((new translate)->translate('You have no authorized over this.'));
        }
        return $next($request);
    }
}
