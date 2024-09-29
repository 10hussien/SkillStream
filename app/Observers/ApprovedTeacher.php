<?php

namespace App\Observers;

use App\Models\Teacher;
use App\Notifications\AcceptTeacher;


class ApprovedTeacher
{
    public function updated(Teacher $teacher): void
    {
        if ($teacher->approved == 1) {
            $user = $teacher->user;
            if ($user->role == 'student') {
                $user->role = 'teacher';
                $user->save();
            }
            $user->notify(new AcceptTeacher($user->first_name . ' ' .   $user->last_name));
        }
    }
}
