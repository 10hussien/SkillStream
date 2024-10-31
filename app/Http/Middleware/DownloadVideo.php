<?php

namespace App\Http\Middleware;

use App\Models\VideoCourse;
use App\utils\translate;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DownloadVideo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $video_course_id = $request->route('video_course_id');

        $videoCourse = VideoCourse::Video($video_course_id);

        if ($videoCourse == 'this video not found') {

            return response()->json((new translate)->translate($videoCourse));
        }

        if (!$videoCourse['download_video']) {

            return response()->json((new translate)->translate('This video is not downloadable.'), 403);
        }

        return $next($request);
    }
}
