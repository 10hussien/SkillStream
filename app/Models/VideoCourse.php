<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'video_url',
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

    public function view()
    {
        return $this->belongsToMany(User::class, 'video_views', 'video_course_id', 'user_id')
            ->orderBy('video_views.created_at');
    }

    public function downloadUser()
    {
        return $this->belongsToMany(User::class, 'download_videos', 'video_course_id', 'user_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }



    public function solutionQuiz()
    {
        return $this->hasManyThrough(QuizAnswer::class, Quiz::class, 'video_course_id', 'quizzes_id');
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

    public function getVideoAttribute($value)
    {
        return asset('videos/' . $value);
    }

    public function getThumbnailAttribute($value)
    {
        return asset('images/' . $value);
    }

    public function viewed()
    {
        $this->increment('views');
        $this->save();
    }
}
