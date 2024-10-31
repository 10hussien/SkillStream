<?php

namespace App\Http\Controllers;

use App\Models\ScoreFinal;
use App\utils\translate;
use Illuminate\Support\Facades\Auth;

class ScoreFinalController extends Controller
{
    public function scoreFinalForUser($course_id)
    {

        $questionAswnsers = (new QuestionAnswerController)->solvedUser($course_id);

        $scor = 0;

        if ($questionAswnsers->original == (new translate)->translate('you didnt  solved any question to this course')) {
            return response()->json((new translate)->translate($questionAswnsers->original), 404);
        }

        if ($questionAswnsers->original == (new translate)->translate('you didnt had any solved to question for this course')) {
            return response()->json((new translate)->translate($questionAswnsers->original), 404);
        }


        foreach ($questionAswnsers->original as $questionAswnser) {

            $question = $questionAswnser->questionBank;

            if ($questionAswnser->is_correct) {

                $scor += $question->marks;
            }
        }

        ScoreFinal::FirstOrCreate([
            'user_id' => Auth::id(),
            'course_id' => $course_id,
            'score' => $scor
        ]);

        return response()->json([(new translate)->translate('marks Final') => $scor]);
    }
}
