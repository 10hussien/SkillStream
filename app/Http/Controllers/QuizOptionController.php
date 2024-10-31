<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizOptionRequest;
use App\Models\Quiz;
use App\Models\QuizOption;
use App\utils\translate;
use Illuminate\Http\Request;

class QuizOptionController extends Controller
{

    public function addOptionToQuestion($options, $quiz_id)
    {
        $question = Quiz::Quiz($quiz_id);

        if ($question == 'this question not found') {

            return response()->json((new translate)->translate($question), 404);
        }

        foreach ($options  as $option) {
            $add = QuizOption::create([
                'quizzes_id' => $quiz_id,
                'option_text' => $option['option_text'],
                'is_correct' => $option['is_correct']
            ]);

            if (isset($option['interpretation']) && !empty($option['interpretation'])) {
                $add['interpretation'] = $option['interpretation'];
                $add->save();
            }

            if (!$add) {
                return response()->json((new translate)->translate('There was a problem adding, please try again later.'), 404);
            }
        }

        return response()->json((new translate)->translate('Question options have been added with which option is correct.'), 200);
    }
}
