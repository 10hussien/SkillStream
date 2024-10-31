<?php

namespace App\Http\Requests;

use App\utils\translate;
use Illuminate\Foundation\Http\FormRequest;

class ResourcesRequest extends FormRequest
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
            'resources' => 'required|array',
            'resourcrs.*.resources_type' => 'required|string',
            'resourcrs.*.resources_link' => 'required|url',
        ];
    }

    public function messages()
    {
        return [

            'resources' => (new translate)->translate('plesae enter resources for this course'),
            'resourcrs.*.resources_type' => (new translate)->translate('please enter resource type'),
            'resourcrs.*.resources_link' => (new translate)->translate('plesase enter resource link'),
        ];
    }
}
