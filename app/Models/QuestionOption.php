<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_bank_id',
        'option_text',
        'is_correct',
        'interpretation'
    ];

    public function questionBank()
    {
        return $this->belongsTo(QuestionBank::class);
    }
}
