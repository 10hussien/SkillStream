<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use App\Models\VideoCourse;
use App\utils\translate;


class QuizController extends Controller
{





    public function addQuestionToVideo(QuizRequest $request, $video_course_id)
    {
        $video = VideoCourse::Video($video_course_id);

        if ($video == 'this video not found') {

            return response()->json((new translate)->translate($video), 404);
        }
        $questions = $request->input('questions');

        foreach ($questions as $question) {
            $addQuestion = Quiz::create([
                'video_course_id' => $video_course_id,
                'question_text' => $question['question_text'],
                'question_type' => $question['question_type'],
            ]);

            if (isset($question['marks']) && !empty($question['marks'])) {

                $addQuestion['marks'] = $question['marks'];

                $addQuestion->save();
            }

            if (isset($question['options']) && !empty($question['options'])) {
                $addOptions = (new QuizOptionController)->addOptionToQuestion($question['options'], $addQuestion->id);
            }
        }

        return response()->json((new translate)->translate('All question has been added to the video.'), 200);
    }



    public function allQuestionToVideo($video_course_id)
    {
        $video = VideoCourse::Video($video_course_id);

        if ($video == 'this video not found') {

            return response()->json((new translate)->translate($video), 404);
        }

        $questions = $video->quizzes;

        if ($questions->isEmpty()) {

            return response()->json((new translate)->translate('This video has no questions.'), 404);
        }

        foreach ($questions as $question) {

            $option[] = $question->option;
        }

        return response()->json($questions, 200);
    }



    public function showQuestion($quiz_id)
    {
        $question = Quiz::Quiz($quiz_id);

        if ($question == 'this question not found') {

            return response()->json((new translate)->translate($question));
        }

        $option = $question->option;

        if ($option->isEmpty()) {

            return response()->json((new translate)->translate('This question has no option.'), 404);
        }

        return response()->json($question, 200);
    }
}
