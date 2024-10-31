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
        'question_type',
        'marks'
    ];


    public function videoCourse()
    {
        return $this->belongsTo(VideoCourse::class);
    }

    public function option()
    {
        return $this->hasMany(QuizOption::class, 'quizzes_id', 'id');
    }

    public function quizAnswer()
    {
        return $this->belongsToMany(QuizAnswer::class, 'quizzes_id', 'id');
    }


    public function scopeQuiz($query, $id)
    {
        $question = Quiz::find($id);
        if (!$question) {
            return 'this question not found';
        }
        return $question;
    }
}
