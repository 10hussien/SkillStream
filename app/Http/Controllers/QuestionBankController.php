<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionBankRequest;
use App\Models\Course;
use App\Models\QuestionBank;
use App\utils\translate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class QuestionBankController extends Controller
{
    public function addQuestionToBank(QuestionBankRequest $request, $course_id)
    {
        $course = Course::Course($course_id);

        if ($course == 'There are no course') {

            return response()->json((new translate)->translate($course), 404);
        }

        $questions = $request->input('questions');
        if (empty($questions)) {
            return response()->json((new translate)->translate('You have not entered any question.'), 400);
        }

        foreach ($questions as $question) {
            $add = QuestionBank::create([
                'course_id' => $course_id,
                'question_text' => $question['question_text'],
                'question_type' => $question['question_type'],
                'difficulty_level' => $question['difficulty_level']
            ]);

            if (isset($question['options']) && !empty($question['options'])) {
                $addOptions = (new QuestionOptionController)->addQuestionOption($question['options'], $add->id);
            }

            if (!$add) {
                return response()->json((new translate)->translate('There was a problem adding this question. Please enter the question again.'), 404);
            }
        }
        return response()->json((new translate)->translate('All questions have been added successfully.'), 200);
    }


    public function showQuestionBank($question_id)
    {
        $question = QuestionBank::Question($question_id);
        if ($question == 'this question not found') {
            return response()->json((new translate)->translate($question), 404);
        }

        $options = $question->Questionoption;

        if ($options->isEmpty()) {
            return response()->json([$question, (new translate)->translate('you are not any option to this question')], 404);
        }

        return response()->json($question, 200);
    }


    public function showQuestionForUser($course_id)
    {
        $user = Auth::id();
        if (Cache::has("question{$user}")) {
            return response()->json(Cache::get("question{$user}"), 200);
        } else {
            $questions = QuestionBank::Where('course_id', $course_id)
                ->inRandomOrder()
                ->take(5)
                ->get();
            foreach ($questions as $question) {
                $options[] = [
                    $option = $question->Questionoption,
                ];
            }
            Cache::put("question{$user}", $questions, 86400);
            return response()->json($questions, 200);
        }
    }
}
