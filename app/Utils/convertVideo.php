<?php

namespace App\utils;

use FFMpeg\Coordinate\Dimension;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Filters\Video\ResizeFilter;
use FFMpeg\Format\Video\X264;



class convertVideo
{
    public function convertVideo($video)
    {
        $filepath = public_path("videos/$video");

        $formats = $this->getVideoFormats($filepath);

        foreach ($formats as $format) {
            $result = $this->converToResolution($filepath, $format);
            $all[] =
                [
                    'name_video' => $result,
                    'resolution' => $format['resolution']
                ];
        }
        return $all;
    }

    public function getVideoFormats($filepath)
    {

        $ffprobe = FFProbe::create();

        $streams = $ffprobe->streams($filepath);

        $videoStream = $streams->videos()->first();

        $resolution = $videoStream->get('width') . 'x' . $videoStream->get('height');

        if ($resolution == '1920x1080') {
            $formats = [
                ['rate' => '4096', 'resolution' => '1080p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(1920, 1080), 'dim1' => 1920, 'dim2' => 1080],
                ['rate' => '2048', 'resolution' => '720p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(1280, 720), 'dim1' => 1280, 'dim2' => 720],
                ['rate' => '750', 'resolution' => '480p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(854, 480), 'dim1' => 854, 'dim2' => 480],
                ['rate' => '276', 'resolution' => '360p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(480, 360), 'dim1' => 480, 'dim2' => 360],
                ['rate' => '150', 'resolution' => '240p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(426, 240), 'dim1' => 426, 'dim2' => 240],
                ['rate' => '100', 'resolution' => '144p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(256, 144), 'dim1' => 256, 'dim2' => 144],
            ];
        } elseif ($resolution == '1280x720') {
            $formats = [

                ['rate' => '2048', 'resolution' => '720p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(1280, 720), 'dim1' => 1280, 'dim2' => 720],
                ['rate' => '750', 'resolution' => '480p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(854, 480), 'dim1' => 854, 'dim2' => 480],
                ['rate' => '276', 'resolution' => '360p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(480, 360), 'dim1' => 480, 'dim2' => 360],
                ['rate' => '150', 'resolution' => '240p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(426, 240), 'dim1' => 426, 'dim2' => 240],
                ['rate' => '100', 'resolution' => '144p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(256, 144), 'dim1' => 256, 'dim2' => 144],
            ];
        } elseif ($resolution == '854x480') {
            $formats = [
                ['rate' => '750', 'resolution' => '480p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(854, 480), 'dim1' => 854, 'dim2' => 480],
                ['rate' => '276', 'resolution' => '360p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(480, 360), 'dim1' => 480, 'dim2' => 360],
                ['rate' => '150', 'resolution' => '240p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(426, 240), 'dim1' => 426, 'dim2' => 240],
                ['rate' => '100', 'resolution' => '144p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(256, 144), 'dim1' => 256, 'dim2' => 144],
            ];
        } else if ($resolution == '480x360') {
            $formats = [
                ['rate' => '276', 'resolution' => '360p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(480, 360), 'dim1' => 480, 'dim2' => 360],
                ['rate' => '150', 'resolution' => '240p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(426, 240), 'dim1' => 426, 'dim2' => 240],
                ['rate' => '100', 'resolution' => '144p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(256, 144), 'dim1' => 256, 'dim2' => 144],
            ];
        } else if ($resolution == '426x240') {
            $formats = [
                ['rate' => '150', 'resolution' => '240p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(426, 240), 'dim1' => 426, 'dim2' => 240],
                ['rate' => '100', 'resolution' => '144p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(256, 144), 'dim1' => 256, 'dim2' => 144],
            ];
        } else if ($resolution == '426x240') {
            $formats = [
                ['rate' => '150', 'resolution' => '240p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(426, 240), 'dim1' => 426, 'dim2' => 240],
                ['rate' => '100', 'resolution' => '144p', 'format' => new X264('aac', 'libx264', 'mp4'), 'dimension' => new Dimension(256, 144), 'dim1' => 256, 'dim2' => 144],
            ];
        } else {
            $format = [];
        }
        return $formats;
    }


    public function converToResolution($filepath, $format)
    {
        $uuid = uniqid();
        $randomVideoName = "$uuid-{$format['resolution']}.mp4";
        if (!\File::exists(public_path('videos/'))) {
            $path = public_path('videos/');

            \File::makeDirectory($path, 0777, true, true);
        }
        $output = public_path('videos/' . $randomVideoName);

        $resizeFilter = new ResizeFilter($format['dimension'], ['crf', '23']);

        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($filepath);

        $formats = new X264('libmp3lame', 'libx264');
        $formats->setKiloBitrate($format['rate']);

        $video->addFilter($resizeFilter)->save($formats, $output);

        return $randomVideoName;
    }
}
