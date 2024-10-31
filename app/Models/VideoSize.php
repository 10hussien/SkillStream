<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoSize extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_course_id',
        'video',
        'resolution',
    ];

    public function VideoCourse()
    {
        return $this->belongsTo(VideoCourse::class);
    }

    public function getVideoAttribute($video)
    {
        return asset('videos/' . $video);
    }
}
