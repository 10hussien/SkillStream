<?php

namespace App\Http\Requests;

use App\utils\translate;
use Illuminate\Foundation\Http\FormRequest;

class QuestionOptionRequest extends FormRequest
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
            'options' => 'array|required',
            'options.*.option_text' => 'required|string',
            'options.*.is_correct' => 'required',
            'options.*.interpretation' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'options' => (new translate)->translate('please enter options to questions'),
            'options.*.option_text' => (new translate)->translate('please enter option text'),
            'options.*.is_correct' => (new translate)->translate('please enter if option is correct or not'),
        ];
    }
}
