<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'question_bank_id',
        'question_option_id',
        'is_correct'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function questionBank()
    {
        return $this->belongsTo(QuestionBank::class);
    }
}
