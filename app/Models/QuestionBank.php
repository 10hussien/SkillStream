<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'question_text',
        'question_type',
        'difficulty_level',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function option()
    {
        return $this->hasMany(QuestionOption::class);
    }

    public function questionAnswer()
    {
        return $this->belongsToMany(QuestionAnswer::class);
    }
}