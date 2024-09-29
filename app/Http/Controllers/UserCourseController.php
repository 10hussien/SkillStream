<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\UserCourse;
use App\utils\translate;
use Illuminate\Support\Facades\Auth;

class UserCourseController extends Controller
{
    public function registerCourse($id)
    {
        $course = Course::Course($id);

        if ($course == 'There are no course') {

            return response()->json((new translate)->translate('There are no course'), 404);
        }

        $userId = Auth::id();

        UserCourse::firstOrCreate(
            [
                'user_id' => $userId,
                'course_id' => $course->id
            ]
        );

        return response()->json((new translate)->translate('The course has been registered and is awaiting the teachers approval.'), 200);
    }

    public function UsersRegisteredInTheCourse($id)
    {
        $course = Course::Course($id);

        if ($course == 'There are no course') {

            return response()->json((new translate)->translate('There are no course'), 404);
        }

        $users = $course->users;

        if ($users->isEmpty()) {

            return response()->json((new translate)->translate('There are no registered users in this course.'), 404);
        }
        return response()->json($users, 200);
    }

    public function CoursesRegisteredByUsers($id)
    {
        $user = User::User($id);

        if ($user == 'User not found') {

            return response()->json((new translate)->translate('User not found'), 404);
        }
        $courses = $user->courses;

        if ($courses->isEmpty()) {

            return response()->json((new translate)->translate('User is not registered in any course'), 404);
        }

        return response()->json($courses, 200);
    }


    public function RegisterMyCourses()
    {
        $user = Auth::user();

        $courses = $user->courses;

        if (!$courses) {

            return response()->json((new translate)->translate('You are not registered in any course'), 404);
        }

        return response()->json($courses, 200);
    }


    public function DeleteCourseRegistration($id)
    {
        $course = Course::Course($id);

        if ($course == 'There are no course') {

            return response()->json((new translate)->translate('There are no course'), 404);
        }

        $userId = Auth::id();

        $deleted = UserCourse::where('user_id', $userId)

            ->where('course_id', $course->id)

            ->delete();

        if ($deleted) {

            return response()->json((new translate)->translate('The course has been removed successfully.'));
        } else {

            return response()->json((new translate)->translate('No relationship found to delete.'), 404);
        }
    }
}
