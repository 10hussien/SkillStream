<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionAnswerRequest;
use App\Models\Course;
use App\Models\QuestionAnswer;
use App\Models\QuestionBank;
use App\Models\QuestionOption;
use App\utils\translate;
use Illuminate\Support\Facades\Auth;

class QuestionAnswerController extends Controller
{
    public function solveQuestion(QuestionAnswerRequest $request)
    {
        $answers = $request->input('answers');

        if (empty($answers)) {
            return response()->json((new translate)->translate('You did not solve any question.'), 404);
        }

        $alreadySolved = [];

        foreach ($answers as $answer) {

            $question_id = $answer['question_bank_id'];

            $option_id = $answer['question_option_id'];

            $existingAnswer = QuestionAnswer::where('user_id', Auth::id())

                ->where('question_bank_id', $question_id)

                ->first();

            $question = QuestionBank::Question($question_id);

            if ($question == 'this question not found') {

                return response()->json((new translate)->translate($question), 404);
            }

            if ($existingAnswer) {
                $alreadySolved[] = [
                    'question' => $question->question_text,
                    'message' => (new translate)->translate('You have already solved this question.', 404)
                ];
                continue;
            }

            $option = QuestionOption::find($option_id);

            if (!$option) {
                $is_correct = 0;
            } else {
                $is_correct = $option->is_correct;
            }

            QuestionAnswer::FirstOrCreate([
                'user_id' => Auth::id(),
                'question_bank_id' => $question_id,
                'question_option_id' => $option_id,
                'is_correct' => $is_correct
            ]);
        }

        if (!empty($alreadySolved)) {

            return response()->json([(new translate)->translate('The previously solved questions were ignored and the solutions to the remaining questions were sent.'), $alreadySolved], 200);
        }

        return response()->json((new translate)->translate('All questions have been solved'), 200);
    }


    public function solvedUser($course_id)
    {
        $user = Auth::id();
        $course = Course::Course($course_id);
        if ($course == 'There are no course') {
            return response()->json((new translate)->translate($course), 404);
        }
        $answers = $course->answerQuestion;
        if (empty($answers)) {
            return  response()->json((new translate)->translate('you didnt had any solved to question for this course'), 404);
        }
        $userAnswers = [];
        foreach ($answers as $answer) {
            if ($answer->user_id == $user) {
                $userAnswers[] = $answer;
            }
        }
        if (empty($userAnswers)) {
            return response()->json((new translate)->translate('you didnt  solved any question to this course'), 404);
        }
        return response()->json($userAnswers, 200);
    }
}
