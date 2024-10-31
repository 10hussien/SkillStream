<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'quizzes_id',
        'quiz_options_id',
        'is_correct'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quizzes_id', 'id');
    }


    public function option()
    {
        return $this->belongsTo(QuizOption::class, 'quiz_options_id', 'id');
    }
}
