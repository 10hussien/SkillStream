<?php

namespace App\utils;

use Illuminate\Support\Str;

class uploadVideo
{

    public function uploadvideo($video)
    {
        $video_name = Str::uuid() . date('YmdHis') . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('videos/'), $video_name);
        return  $video_name;
    }
}
