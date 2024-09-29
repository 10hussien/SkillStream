<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseProject extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'project_name',
        'project_description',
        'project_start',
        'project_end',
        'project_status',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function userProject()
    {
        return $this->belongsToMany(UserProject::class);
    }
    public function comment()
    {
        return $this->belongsToMany(CommentProject::class);
    }
}
