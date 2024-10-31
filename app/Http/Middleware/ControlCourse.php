<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\utils\translate;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ControlCourse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::id();
        $course_id = $request->route('course_id');
        $course = Course::find($course_id);
        if (!$course) {
            return response()->json((new translate)->translate('There are no courses'), 404);
        }
        if ($course->user_id == $user) {
            return $next($request);
        } else {
            return response()->json((new translate)->translate('You cannot control the information in this course, you do not own it.', 403));
        }
    }
}
