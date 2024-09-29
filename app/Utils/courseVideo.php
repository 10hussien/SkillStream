<?php

namespace App\utils;

use Illuminate\Support\Str;

class courseVideo
{

    public function coursevideo($video)
    {
        $video_name = Str::uuid() . date('YmdHis') . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('pdfs'), $video_name);
        return  $video_name;
    }
}
