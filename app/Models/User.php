<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }



    public function CourseTeacher()
    {
        return $this->hasMany(Course::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'user_courses');
    }

    public function videoTeacher()
    {
        return $this->hasManyThrough(VideoCourse::class, Course::class);
    }

    public function views()
    {
        return $this->belongsToMany(VideoCourse::class, 'video_views', 'user_id', 'video_course_id')
            ->orderBy('video_views.created_at', 'desc');
    }

    public function downloadVideo()
    {
        return $this->belongsToMany(VideoCourse::class, 'download_videos', 'user_id', 'video_course_id');
    }


    public function quizAnswer()
    {
        return $this->belongsToMany(QuizAnswer::class);
    }

    public function questionAnswer()
    {
        return $this->belongsToMany(QuestionAnswer::class);
    }

    public function scoreQuiz()
    {
        return $this->belongsToMany(QuizScore::class);
    }

    public function scoreFinal()
    {
        return $this->belongsToMany(ScoreFinal::class);
    }


    public function projectUser()
    {
        return $this->belongsToMany(CourseProject::class, 'user_projects', 'user_id', 'course_project_id');
    }

    public function comment()
    {
        return $this->belongsToMany(CourseProject::class, 'comment_projects', 'user_id', 'course_project_id');
    }

    public function resources()
    {
        return $this->belongsToMany(AdditionalResource::class);
    }

    public function search()
    {
        return $this->hasMany(Search::class);
    }

    public function commentApplication()
    {
        return $this->hasMany(CommentApplication::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follower_teachers', 'user_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follower_teachers', 'follower_id', 'user_id');
    }


    public function blockedUsers()
    {

        return $this->belongsToMany(User::class, 'blocks', 'user_id', 'blocked_user_id');
    }

    public function blockedBy()
    {

        return $this->belongsToMany(User::class, 'blocks', 'blocked_user_id', 'user_id');
    }


    public function scopeUser($query, $id)
    {

        $user = User::find($id);

        if (!$user) {
            return 'User not found';
        }
        return $user;
    }
}
