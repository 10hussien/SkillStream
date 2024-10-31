<?php

namespace App\Http\Controllers;

use App\Models\VideoCourse;
use App\utils\translate;
use Illuminate\Support\Facades\Auth;

class VideoViewsController extends Controller
{
    public function viewedVideo()
    {
        $user = Auth::user();

        $videoViews = $user->views;

        if ($videoViews->isEmpty()) {

            return response()->json((new translate)->translate('You have not watched any video'), 404);
        }

        return response()->json($videoViews, 200);
    }

    public function viewedUser($vide_course_id)
    {
        $videoCourse = VideoCourse::find($vide_course_id);

        if (!$videoCourse) {

            return response()->json((new translate)->translate('this are video not found'), 404);
        }

        $user = $videoCourse->view;

        if ($user->isEmpty()) {

            return response()->json((new translate)->translate('You have not watched any user'), 404);
        }

        return response()->json($user, 200);
    }
}
