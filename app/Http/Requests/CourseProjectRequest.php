<?php

namespace App\Http\Requests;

use App\utils\translate;
use Illuminate\Foundation\Http\FormRequest;

class CourseProjectRequest extends FormRequest
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
            'projects' => 'required|array',
            'projects.*.project_name' => 'required|string',
            'projects.*.project_description' => 'required|string',
            'projects.*.project_start' => 'required|date',
            'projects.*.project_end' => 'required|date',
            'projects.*.project_status' => 'required|string',
        ];
    }
    public function messages()
    {
        return [

            'projects' => (new translate)->translate('please enter all or one projects'),
            'projects.*.project_name' => (new translate)->translate('please enter project name'),
            'projects.*.project_description' => (new translate)->translate('please enter project description'),
            'projects.*.project_start' => (new translate)->translate('Please enter the project start date.'),
            'projects.*.project_end' => (new translate)->translate('Please enter the project end date.'),
            'projects.*.project_status' => (new translate)->translate('Please enter the project status.'),
        ];
    }
}
