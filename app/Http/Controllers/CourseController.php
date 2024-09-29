<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Teacher;
use App\utils\translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    public function addCourse(CourseRequest $request)
    {
        $course = $request->all();

        $teacher_id = Auth::user()->teacher->id;

        $course['teacher_id'] = $teacher_id;

        Course::create($course);

        return response()->json((new translate)->translate('The course has been added successfully.'));
    }

    public function showAllCoursesForTeacher($id)
    {
        $user = Teacher::Teacher($id);

        if ($user == 'Teacher not found') {

            return response()->json((new translate)->translate('Teacher not found'), 404);
        }

        $courses = $user->CourseTeacher;

        if ($courses->isEmpty()) {

            return response()->json((new translate)->translate('There are no courses'), 404);
        }

        return response()->json($courses);
    }


    public function showCourse($id)
    {
        $course = Course::Course($id);

        if ($course == 'There are no course') {

            return response()->json((new translate)->translate('There are no course'), 404);
        }

        $video_course = $course->videoCourse;

        return response()->json($course);
    }

    public function updateCourse(Request $request, $id)
    {
        $course = Course::Course($id);

        if ($course == 'There are no course') {

            return response()->json((new translate)->translate('There are no course'), 404);
        }

        $course->update($request->all());

        return response()->json((new translate)->translate('The course has been updated successfully.'));
    }


    public function deleteCourse($id)
    {
        $course = Course::Course($id);

        if ($course == 'There are no course') {

            return response()->json((new translate)->translate('There are no course'), 404);
        }

        if ($course->delete()) {
            $course->delete();
            return response()->json((new translate)->translate('The course has been delete successfully.'));
        } else {
            return response()->json((new translate)->translate('The course will not be deleted.'));
        }
    }
}
