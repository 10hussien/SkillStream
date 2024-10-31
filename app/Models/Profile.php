<?php

namespace App\Models;

use App\utils\translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'personal_photo',
        'address',
        'date',
        'nationality',
        'gender',
        'hobbies',
        'facebook',
        'instagram',
        'getHub',
        'linkedIn',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeProfile($query, $id)
    {
        $user = User::with('profile')->find($id);

        if (!$user) {
            return 'User not found';
        }

        if (!$user->profile) {
            return 'Profile not found';
        }

        return $user;
    }


    public function getPersonalPhotoAttribute($personal_photo)
    {
        return asset('images/' . $personal_photo);
    }
}
