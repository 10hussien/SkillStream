<?php

namespace App\Http\Requests;

use App\utils\translate;
use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
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
            'questions.*.question_type' => 'required',
            'questions.*.marks' => 'nullable|integer',
            'questions.*.options' => 'required|array',
            'options.*.option_text' => 'required|string',
            'options.*.is_correct' => 'boolean|required',
            'options.*.interpretation' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'question_text' => (new translate)->translate('Please enter the text of the question.'),
            'question_type' => (new translate)->translate('Please enter the type of the question.')
        ];
    }
}
