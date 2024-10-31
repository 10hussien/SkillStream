<?php

namespace App\Http\Requests;

use App\utils\translate;
use Illuminate\Foundation\Http\FormRequest;

class QuestionBankRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'questions' => 'required|array',
            'questions.*.question_text' => 'required|string',
            'questions.*.question_type' => 'required|string',
            'questions.*.difficulty_level' => 'required|string',
            'questions.*.options' => 'array|required',
            'options.*.option_text' => 'required|string',
            'options.*.is_correct' => 'required',
            'options.*.interpretation' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'question_text' => (new translate)->translate('Please enter the question text.'),
            'question_type' => (new translate)->translate('Please enter the question type.'),
            'difficulty_level' => (new translate)->translate('Please enter the difficulty level of the question.'),

        ];
    }
}
