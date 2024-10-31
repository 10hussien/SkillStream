<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start_course',
        'end_course',
        'duration'
    ];


    public function teacher()
    {
        return $this->belongsTo(User::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses');
    }

    public function videoCourse()
    {
        return $this->hasMany(VideoCourse::class);
    }
    public function sizeVideos()
    {
        return $this->hasManyThrough(VideoSize::class, VideoCourse::class);
    }

    public function quizzes()
    {
        return $this->hasManyThrough(Quiz::class, VideoCourse::class);
    }

    public function questionBank()
    {
        return $this->hasMany(QuestionBank::class);
    }

    public function answerQuestion()
    {
        return $this->hasManyThrough(QuestionAnswer::class, QuestionBank::class);
    }

    public function scoreFinal()
    {
        return $this->belongsToMany(ScoreFinal::class);
    }

    public function projectsCourse()
    {
        return $this->hasMany(CourseProject::class);
    }

    public function userProject()
    {
        return $this->hasManyThrough(UserProject::class, CourseProject::class);
    }



    public function resources()
    {
        return $this->hasMany(AdditionalResource::class);
    }

    public function scopeCourse($query, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return 'There are no course';
        }
        return $course;
    }
}
