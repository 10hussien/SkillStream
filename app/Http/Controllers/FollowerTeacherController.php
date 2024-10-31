<?php

namespace App\Http\Controllers;

use App\Models\FollowerTeacher;
use App\Models\Teacher;
use App\Models\User;
use App\utils\translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class FollowerTeacherController extends Controller
{
    public function follow($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json((new translate)->translate('this user not found'), 404);
        }

        FollowerTeacher::FirstOrCreate([
            'user_id' => $user_id,
            'follower_id' => Auth::id()
        ]);

        return response()->json(['message' => (new translate)->translate('You are now following this user')]);
    }


    public function unfollow($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json((new translate)->translate('This user no longer exists.'), 404);
        }

        $unfolow = FollowerTeacher::where('user_id', $user_id)
            ->where('follower_id', Auth::id())
            ->first();
        if (!$unfolow) {
            return response()->json((new translate)->translate('you are not following this user'), 404);
        }
        $unfolow->delete();

        return response()->json(['message' => (new translate)->translate('You are no longer following this user')]);
    }



    public function showMyFollow()
    {
        $user = Auth::user();

        $allFollow = $user->following;

        if ($allFollow->isEmpty()) {
            return response()->json((new translate)->translate('you dont follow any teacher'), 404);
        }

        return response()->json($allFollow, 200);
    }




    public function showMyFollowers()
    {
        $user = Auth::user();

        $allFollow = $user->followers;

        if ($allFollow->isEmpty()) {
            return response()->json((new translate)->translate('Nobody followed you'), 404);
        }

        return response()->json($allFollow, 200);
    }





    public function showFollowersForTeacher($user_id)
    {
        $teacher = Teacher::Teacher($user_id);

        if ($teacher == 'Teacher not found') {

            return response()->json((new translate)->translate($teacher), 404);
        }

        $allFollow = $teacher->followers;

        if ($allFollow->isEmpty()) {

            return response()->json((new translate)->translate('No student has followed this teacher.'), 404);
        }
        return response()->json($allFollow, 200);
    }



    public function showFollow($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json((new translate)->translate('This user no longer exists.'), 404);
        }

        $allFollow = $user->following;

        if ($allFollow->isEmpty()) {

            return response()->json((new translate)->translate('No one has followed him.'), 404);
        }
        return response()->json($allFollow, 200);
    }

    public function showFollowers($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json((new translate)->translate('This user no longer exists.'), 404);
        }

        $allFollow = $user->followers;

        if ($allFollow->isEmpty()) {

            return response()->json((new translate)->translate('No one followed him.'), 404);
        }
        return response()->json($allFollow, 200);
    }
}
