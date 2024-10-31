<?php

namespace App\Models;

use App\Observers\ApprovedTeacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'cv',
        'specialization',
        'years_of_experience',
        'approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function scopeTeacher($query, $id)
    {
        $user = User::with('teacher')->find($id);
        if (!$user->teacher) {
            return 'Teacher not found';
        }
        return $user;
    }


    public function getCvAttribute($cv)
    {
        return asset('pdfs/' . $cv);
    }
}
