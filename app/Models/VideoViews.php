<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoViews extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'video_course_id',
    ];
    public function videos()
    {
        return $this->belongsTo(VideoCourse::class, 'video_course_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
