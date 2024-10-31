<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResolutionRequest;
use App\Models\VideoCourse;
use App\Models\VideoSize;
use App\utils\translate;

class VideoSizeController extends Controller
{

    public function showResolutionVideo($video_course_id)
    {
        $videoCourse = VideoCourse::find($video_course_id);

        if (!$videoCourse) {

            return response()->json((new translate)->translate('this are video not found'), 404);
        }

        $resolution = $videoCourse->videoSize;

        return response()->json($resolution, 200);
    }

    public function changeResolution(ResolutionRequest $request, $video_course_id)
    {
        $videoCourse = VideoCourse::find($video_course_id);

        if (!$videoCourse) {

            return response()->json((new translate)->translate('this are video not found'), 404);
        }

        $resolution = VideoSize::where('resolution', $request->resolution)->first();

        $videoCourse['video'] = $resolution->video;

        return response()->json($videoCourse->video, 200);
    }
}
