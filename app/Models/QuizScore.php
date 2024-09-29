<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizScore extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'video_course_id',
        'score',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function videoCourse()
    {
        return $this->belongsTo(VideoCourse::class);
    }
}
