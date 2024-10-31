<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoCourseRequest;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\VideoCourse;
use App\Models\VideoSize;
use App\Models\VideoViews;
use App\utils\convertVideo;
use App\utils\translate;
use App\utils\uploadImage;
use App\utils\uploadVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use function PHPUnit\Framework\isNull;

class VideoCourseController extends Controller
{



    public function addVideo(VideoCourseRequest $request, $course_id)
    {
        $course = Course::Course($course_id);

        if ($course == 'There are no course') {

            return response()->json((new translate)->translate('There are no course'), 404);
        }


        $videoCourse = $request->all();

        $videoCourse['course_id'] = $course_id;

        if ($request->hasFile('thumbnail')) {

            $videoCourse['thumbnail'] = (new uploadImage)->uploadimage($request->thumbnail);
        }

        $addVideo = VideoCourse::create($videoCourse);


        if ($addVideo) {

            if ($request->hasFile('video')) {

                $converVideo = $this->converVideo((new uploadVideo)->uploadvideo($request->video), $addVideo->id);

                if ($converVideo != 'Video was converted successfully') {

                    $addVideo->delete();

                    return response()->josn((new translate)->translate('Video copies were not uploaded. You must check your video or re-upload it.'), 404);
                }

                return response()->json((new translate)->translate('The video has been added successfully, and the video has been converted to more than one resolution.'), 200);
            } else if ($request->video === null && $request->video_url === null) {

                $this->deleteVideo($addVideo->id);

                return response()->json((new translate)->translate('Please re-enter the information and add a video or a link to the video.'));
            } elseif ($request->url('video_url')) {

                $videoUrl = $request->video_url;

                $addVideo['video_url'] = $videoUrl;

                $addVideo->update();

                return response()->json((new translate)->translate('The video has been added successfully, It can be viewed in several resolutions via the link..'), 200);
            }
        }
    }







    public function converVideo($video, $id)
    {
        $convertVideos = (new convertVideo)->convertVideo($video);
        try {
            foreach ($convertVideos as $video) {
                VideoSize::firstOrCreate([
                    'video_course_id' => $id,
                    'video' => $video['name_video'],
                    'resolution' => $video['resolution']
                ]);
            }
            return 'Video was converted successfully';
        } catch (\Throwable $th) {
            return 'any thing';
        }
    }


    public function showDescriptionVideo($video_course_id)
    {

        $videoCourse = VideoCourse::find($video_course_id);

        if (!$videoCourse) {
            return response()->json((new translate)->translate('this are video not found'), 404);
        }

        $video =  VideoViews::where('user_id', Auth::id())

            ->where('video_course_id', $video_course_id)

            ->exists();

        if (!$video) {

            VideoViews::firstOrCreate([

                'user_id' => Auth::id(),

                'video_course_id' => $video_course_id

            ]);

            $videoCourse->viewed();
        }

        $quizzes = $videoCourse->quizzes;

        $marks = 0;
        foreach ($quizzes as $quiz) {
            $marks += $quiz->marks;
        }

        $allResolution = $videoCourse->videoSize;

        if (isNull($allResolution)) {

            return response()->json([$videoCourse, $marks], 200);
        }

        $highest = 0;

        foreach ($allResolution as $HighestResolution) {

            if ($HighestResolution['resolution'] > $highest) {

                $highest = $HighestResolution;
            }
        }

        $quizzes = $videoCourse->quizzes;

        $marks = 0;
        foreach ($quizzes as $quiz) {
            $marks += $quiz->marks;
        }

        return response()->json([$videoCourse, $highest->resolution, $marks], 200);
    }



    public function showCourseVideo($course_id)
    {
        $course = Course::Course($course_id);

        if ($course == 'There are no course') {
            return response()->json((new translate)->translate('There are no course'), 404);
        }

        $courseVideos = $course->videoCourse;

        if ($courseVideos->isEmpty()) {

            return response()->json((new translate)->translate('There are no videos for this course.'), 404);
        }

        return response()->json($courseVideos, 200);
    }



    public function showAllVideoToTeacher($user_id)
    {
        $user = Teacher::Teacher($user_id);
        if ($user == 'Teacher not found') {
            return response()->json((new translate)->translate('Teacher not found.'), 404);
        }

        $teacherVideos = $user->videoTeacher;


        if ($teacherVideos->isEmpty()) {
            return response()->json((new translate)->translate('There are no videos for this teacher.'), 404);
        }

        return response()->json($teacherVideos, 200);
    }


    public function updateVideo(Request $request, $video_course_id)
    {
        $videoCourse = VideoCourse::Video($video_course_id);

        if ($videoCourse == 'this video not found') {

            return response()->json((new translate)->translate('this video not found.'), 404);
        }

        $videoCourse->update($request->all());
        return response()->json((new translate)->translate('Video information has been modified.'), 200);
    }


    public function deleteVideo($video_course_id)
    {
        $videoCourse = VideoCourse::Video($video_course_id);

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
