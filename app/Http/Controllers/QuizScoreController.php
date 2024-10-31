<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\QuizAnswer;
use App\Models\VideoCourse;
use App\utils\translate;
use Illuminate\Support\Facades\Auth;

class QuizScoreController extends Controller
{
    public function socreVideoQuiz($video_course_id)
    {

        $video = VideoCourse::Video($video_course_id);

        if ($video == 'this video not found') {
            return response()->json((new translate)->translate($video), 404);
        }
        $quizzes = $video->quizzes;
        if (empty($quizzes)) {
            return response()->json((new translate)->translate('this video dont has any question.'), 404);
        }

        $score = 0;
        $answerWrong = [];

        foreach ($quizzes as $quiz) {

            $answerQuiz = QuizAnswer::where('quizzes_id', $quiz->id)
                ->where('user_id', Auth::id())
                ->first();
            $options = $quiz->option;
            foreach ($options as $option) {
                if ($option->is_correct) {
                    $answerCorrect = $option;
                }
            }

            if (!$answerQuiz) {
                continue;
            }

            if ($answerQuiz->is_correct) {
                $score += $quiz->marks;
            } else {
                $answerWrong[] = [
                    'question' => $quiz->question_text,
                    'youAnswer' => $answerQuiz->option->option_text,
                    'answerCorrect' => $answerCorrect->option_text
                ];
            }
        }
        if (empty($answerWrong)) {

            return response()->json(['marks' => $score], 200);
        };
        return response()->json(['marks' => $score, 'answerWrong' => $answerWrong], 200);
    }


    public function allScorToQuizzes($course_id)
    {

        $course = Course::Course($course_id);

        if ($course == 'There are no course') {

            return response()->json((new translate)->translate($course), 200);
        }

        $videos = $course->videoCourse;

        foreach ($videos as $video) {

            $scor[] =  $this->socreVideoQuiz($video->id);
        }

        return response()->json($scor);
    }
}
