<?php

namespace App\Http\Requests;

use App\utils\translate;
use Illuminate\Foundation\Http\FormRequest;

class QuizOptionRequest extends FormRequest
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
            'option_text' => 'required|string',
            'is_correct' => 'boolean|required',
            'interpretation' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'option_text' => (new  translate)->translate('Please enter the text of the option'),
            'is_correct' => (new translate)->translate('Please enter if this option true or false'),
        ];
    }
}
