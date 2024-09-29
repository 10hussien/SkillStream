<?php

namespace App\Http\Middleware;

use App\utils\translate;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Teacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user->role != 'teacher') {
            return response()->json((new translate)->translate('You are not a teacher, you cannot add courses.'));
        }
        return $next($request);
    }
}
