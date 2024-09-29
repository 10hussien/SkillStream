<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoCourseRequest;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\VideoCourse;
use App\utils\translate;
use App\utils\uploadImage;
use Illuminate\Http\Request;

class VideoCourseController extends Controller
{



    public function addVideo(VideoCourseRequest $request, $id)
    {
        $course = Course::Course($id);
        if ($course == 'There are no course') {
            return response()->json((new translate)->translate('There are no course'), 404);
        }
        $videoCourse = $request->all();
        $videoCourse['course_id'] = $id;
        if ($request->hasFile('thumbnail')) {
            $videoCourse['thumbnail'] = (new uploadImage)->uploadimage($request->thumbnail);
        }
        $addVideo = VideoCourse::create($videoCourse);
        if ($addVideo) {
            return response()->json((new translate)->translate('Video added to the course successfully'), 200);
        } else {
            return response()->json((new translate)->translate('Video not added'), 404);
        }
    }


    public function showCourseVideo($id)
    {
        $course = Course::Course($id);

        if ($course == 'There are no course') {
            return response()->json((new translate)->translate('There are no course'), 404);
        }

        $courseVideos = $course->videoCourse;

        if ($courseVideos->isEmpty()) {

            return response()->json((new translate)->translate('There are no videos for this course.'), 404);
        }

        return response()->json($courseVideos, 200);
    }


    public function showAllVideoToTeacher($id)
    {
        $user = Teacher::Teacher($id);
        if ($user == 'Teacher not found') {
            return response()->json((new translate)->translate('Teacher not found.'), 404);
        }

        $teacherVideos = $user->videoTeacher;

        if ($teacherVideos->isEmpty()) {
            return response()->json((new translate)->translate('There are no videos for this teacher.'), 404);
        }

        return response()->json($teacherVideos, 200);
    }


    public function updateVideo(Request $request, $id)
    {
        $videoCourse = VideoCourse::Video($id);

        if ($videoCourse == 'this video not found') {

            return response()->json((new translate)->translate('this video not found.'), 404);
        }

        $videoCourse->update($request->all());
        return response()->json((new translate)->translate('Video information has been modified.'), 200);
    }


    public function deleteVideo($id)
    {
        $videoCourse = VideoCourse::Video($id);

        if ($videoCourse == 'this video not found') {

            return response()->json((new translate)->translate('this video not found.'), 404);
        }

        if ($videoCourse->delete()) {
            $videoCourse->delete();
            return response()->json((new translate)->translate('The video has been delete successfully.'));
        } else {
            return response()->json((new translate)->translate('The video will not be deleted.'));
        }
    }
}
