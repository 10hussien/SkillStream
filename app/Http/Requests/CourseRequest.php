<?php

namespace App\Http\Requests;

use App\utils\translate;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'start_course' => 'nullable',
            'end_course' => 'nullable',
            'duration' => 'nullable',
        ];
    }

    public function message()
    {
        return [
            'title' => (new translate)->translate('Please enter course title.'),
            'description' => (new translate)->translate('Please enter course description.'),
            'start_course' => (new translate)->translate('Please enter start course  as a date.'),
            'end_course' => (new translate)->translate('Please enter end course  as a date.'),
            'duration' => (new translate)->translate('Please enter duration course  as a time.'),
        ];
    }
}
