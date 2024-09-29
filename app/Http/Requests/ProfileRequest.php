<?php

namespace App\Http\Requests;

use App\utils\translate;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'personal_photo' => 'required|image|mimes:png,jpg,svg,web,jpeg|max:2048',
            'address' => 'required|string',
            'date' => 'required|date',
            'nationality' => 'required|string',
            'gender' => 'required|string',
            'hobbies' => 'string',
            'facebook' => 'url',
            'instagram' => 'url',
            'getHub' => 'url',
            'linkedIn' => 'url',
        ];
    }
    public function messages(): array
    {
        return [
            'personal_photo' => (new translate)->translate('Please enter your profile picture.'),
            'address' => (new translate)->translate('Please enter your address.'),
            'date' => (new translate)->translate('Please enter your date of birth.'),
            'nationality' => (new translate)->translate('Please enter your nationality.'),
            'gender' => (new translate)->translate('Please enter your gender.'),
            'hobbies' => (new translate)->translate('Please enter a string'),
            'facebook' => (new translate)->translate('Please enter a link'),
            'instagram' => (new translate)->translate('Please enter a link'),
            'getHub' => (new translate)->translate('Please enter a link'),
            'linkedIn' => (new translate)->translate('Please enter a link'),

        ];
    }
}
