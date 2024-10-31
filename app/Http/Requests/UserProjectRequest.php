<?php

namespace App\Http\Requests;

use App\utils\translate;
use Illuminate\Foundation\Http\FormRequest;

class UserProjectRequest extends FormRequest
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
            'project_link' => 'required|url',
            'marks' => 'nullable|integer'
        ];
    }

    public function messages()
    {
        return [
            'project_link' => (new translate)->translate('please upload link project such as github,linkedin,ect'),
        ];
    }
}
