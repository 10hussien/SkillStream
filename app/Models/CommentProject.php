<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentProject extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'course_project_id',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projectCourse()
    {
        return $this->belongsTo(CourseProject::class);
    }
}
