<?php

namespace App\Http\Requests;

use App\utils\translate;
use Illuminate\Foundation\Http\FormRequest;

class QuestionAnswerRequest extends FormRequest
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
            'answers' => 'required|array',
            'answers.*.question_bank_id' => 'required',
            'answers.*.question_option_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'answers' => (new translate)->translate('please enter answers to question'),
            'answers.*.question_bank_id' => (new translate)->translate('please enter question'),
            'answers.*.question_option_id' => (new translate)->translate('please enter option for question'),
        ];
    }
}
