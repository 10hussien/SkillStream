<?php

namespace App\Http\Middleware;

use App\Models\VideoCourse;
use App\utils\translate;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ControlVideo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::id();
        $video_course_id = $request->route('video_course_id');
        $video = VideoCourse::find($video_course_id);
        if (!$video) {
            return response()->json((new translate)->translate('There are no course video'), 404);
        }
        $course = $video->course;
        if ($course->user_id == $user) {
            return $next($request);
        } else {
            return response()->json((new translate)->translate('You cannot control the information in this course, you do not own it.'), 403);
        }
    }
}
