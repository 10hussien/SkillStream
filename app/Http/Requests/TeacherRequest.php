<?php

namespace App\Http\Requests;

use App\utils\translate;
use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'cv' => 'required|mimes:pdf|max:2048',
            'specialization' => 'required|string',
            'years_of_experience' => 'required|string',
        ];
    }
    public function message(): array
    {
        return [
            'cv' => (new translate)->translate('Please enter your CV.'),
            'specialization' => (new translate)->translate('Please enter your specialization.'),
            'years_of_experience' => (new translate)->translate('Please enter your years of experience.'),
        ];
    }
}
