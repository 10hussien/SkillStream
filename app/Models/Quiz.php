<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_course_id',
        'question_text',
        'question_type'
    ];


    public function videoCourse()
    {
        return $this->belongsTo(VideoCourse::class);
    }

    public function option()
    {
        return $this->hasMany(QuizOption::class);
    }

    public function quizAnswer()
    {
        return $this->belongsToMany(QuizAnswer::class);
    }
}
