<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResolutionRequest;
use App\Models\DownloadVideo;
use App\Models\VideoCourse;
use App\utils\translate;
use Illuminate\Support\Facades\Auth;
use Psy\VersionUpdater\Downloader;

use function PHPUnit\Framework\isNull;

class DownloadVideoController extends Controller
{
    public function dwonloadVideo(ResolutionRequest $request, $video_course_id)
    {
        $video = VideoCourse::find($video_course_id);
        if (!$video) {
            return response()->json((new translate)->translate('this are video not found'));
        }
        $reslution = $video->videoSize;
        if (isNull($reslution)) {
        }
        $size = $request->resolution;
        foreach ($reslution as $key) {
            if ($key->resolution == $size) {
                $reslution = $key;
            }
        }

        DownloadVideo::FirstOrCreate([
            'user_id' => Auth::id(),
            'video_course_id' => $video_course_id,
            'download_status' => 'Downloading',
        ]);


        return response()->download(public_path($reslution->video), $video->title);
    }

    public function allDownloadVideo()
    {
        $user = Auth::user();

        $allDownloadVideo = $user->downloadVideo;

        if ($allDownloadVideo->isEmpty()) {

            return response()->json((new translate)->translate('You have not downloaded any video.'), 404);
        }

        return response()->json($allDownloadVideo, 200);
    }

    public function AllUserDownload($video_course_id)
    {

        $videoCourse = VideoCourse::Video($video_course_id);

        if ($videoCourse == 'this video not found') {
            return response()->json((new translate)->translate($videoCourse), 404);
        }

        $downloadUser = $videoCourse->downloadUser;

        $countUser = $downloadUser->count();

        return response()->json([$downloadUser, $countUser], 200);
    }
}
