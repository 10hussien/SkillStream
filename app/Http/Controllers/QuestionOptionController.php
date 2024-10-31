<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionOptionRequest;
use App\Models\QuestionBank;
use App\Models\QuestionOption;
use App\utils\translate;

class QuestionOptionController extends Controller
{

    public function addQuestionOption($options, $question_id)
    {
        $question = QuestionBank::Question($question_id);
        if ($question == 'this question not found') {
            return response()->json((new translate)->translate($question), 404);
        }

        // $options = $request->input('options');
        if (!$options) {
            return response()->json((new translate)->translate('you are not any option to questions'), 404);
        }

        foreach ($options as $option) {
            $add = QuestionOption::create([
                'question_bank_id' => $question_id,
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

        return response()->json((new translate)->translate('All options added'), 200);
    }
}
