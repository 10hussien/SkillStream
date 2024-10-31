<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'quizzes_id',
        'option_text',
        'is_correct',
        'Interpretation'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    public function answer()
    {
        return $this->hasOne(QuizAnswer::class, 'quiz_options_id', 'id');
    }
}
