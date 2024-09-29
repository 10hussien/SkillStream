<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'thumbnail',
        'duration',
        'views',
        'download_video',
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function videoSize()
    {
        return $this->hasMany(VideoSize::class);
    }

    public function downloadUser()
    {
        return $this->belongsToMany(User::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function scoreQuiz()
    {
        return $this->belongsToMany(QuizScore::class);
    }


    public function scopeVideo($query, $id)
    {
        $video = VideoCourse::find($id);
        if (!$video) {
            return 'this video not found';
        }
        return $video;
    }
}
