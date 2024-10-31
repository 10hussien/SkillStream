<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizOption;
use App\Models\VideoCourse;
use App\utils\translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizAnswerController extends Controller
{

    // public function solutionQuiz(Request $request, $quiz_id)
    // {
    //     $quiz = Quiz::Quiz($quiz_id);

    //     if ($quiz == 'this question not found') {

    //         return response()->json((new translate)->translate($quiz), 404);
    //     }

    //     $option = $request->quiz_option_id;

    //     $existingAnswer = QuizAnswer::where('user_id', Auth::id())
    //         ->where('quizzes_id', $quiz_id)
    //         ->first();

    //     if ($existingAnswer) {
    //         return response()->json((new translate)->translate('You have already solved this question.'), 409);
    //     }

    //     $option = QuizOption::find($option);

    //     QuizAnswer::FirstOrCreate([

    //         'user_id' => Auth::id(),

    //         'quizzes_id' => $quiz_id,

    //         'quiz_options_id' => $option->id,

    //         'is_correct' => $option->is_correct

    //     ]);

    //     return response()->json((new translate)->translate('This question has been solved.'), 200);
    // }



    public function solutionQuiz(Request $request)
    {
        $quizzes = $request->quizzes;

        if (empty($quizzes)) {

            return response()->json((new translate)->translate('No quizzes provided.'), 400);
        }

        $responses = [];
        $alreadySolved = [];
        // $startTime = microtime(true);  بداية وقت الحل



        foreach ($quizzes as $quizData) {

            $quizzes_id = $quizData['quizzes_id'];

            $option_id = $quizData['quiz_options_id'];

            $quiz = Quiz::Quiz($quizzes_id);

            if ($quiz == 'this question not found') {

                return response()->json((new translate)->translate($quiz), 404);
            }

            $existingAnswer = QuizAnswer::where('user_id', Auth::id())

                ->where('quizzes_id', $quizzes_id)

                ->first();

            if ($existingAnswer) {
                $alreadySolved[] = [
                    'quizzes_id' => $quizzes_id,
                    'message' => (new translate)->translate('You have already solved this question.')
                ];
                continue;
            }

            $option = QuizOption::find($option_id);

            if (!$option) {
                return response()->json((new translate)->translate('Option not found for quiz id: ' . $quizzes_id), 404);
            }

            QuizAnswer::create([
                'user_id' => Auth::id(),
                'quizzes_id' => $quizzes_id,
                'quiz_options_id' => $option->id,
                'is_correct' => $option->is_correct
            ]);
        }

        // $endTime = microtime(true); نهاية وقت الحل

        // $timeTaken = round($endTime - $startTime, 2);  المدة المستغرقة بالثواني

        if (!empty($alreadySolved)) {

            return response()->json((new translate)->translate('All the questions that you did not solve have been solved.'));
        }


        return response()->json((new translate)->translate('All questions have been solved.'));

        // if (!empty($alreadySolved)) {
        //     return response()->json([
        //         'message' => (new translate)->translate('All the questions that you did not solve have been solved.'),
        //         'time_taken' => $timeTaken
        //     ]);
        // }

        // return response()->json([
        //     'message' => (new translate)->translate('All questions have been solved.'),
        //     'time_taken' => $timeTaken
        // ]);  ارجاع القيم مع الوقت المستغرق بالثواني


    }




    public function allSolutionToVideo($video_course_id)
    {
        $video = VideoCourse::Video($video_course_id);

        if ($video == 'this video not found') {

            return response()->json((new translate)->translate($video), 404);
        }

        $userSolutions = $video->solutionQuiz;

        $solution = [];
        foreach ($userSolutions as $userSolution) {
            if ($userSolution['user_id'] == Auth::id()) {
                $solution[] = $userSolution;
            }
        }


        if (empty($solution)) {
            return response()->json((new translate)->translate('You have not solved this video quiz.'), 404);
        }

        return response()->json($solution, 200);
    }
}
