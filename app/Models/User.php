<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Psy\VersionUpdater\Downloader;

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


    public function downloadVideo()
    {
        return $this->belongsToMany(VideoCourse::class);
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
        return $this->belongsToMany(UserProject::class);
    }
    public function comment()
    {
        return $this->belongsToMany(CommentProject::class);
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
    public function follower()
    {
        return $this->belongsToMany(FollowerTeacher::class);
    }

    public function block()
    {
        return $this->belongsToMany(Block::class);
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