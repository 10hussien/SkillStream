<?php

namespace App\Http\Requests;

use App\utils\translate;
use Illuminate\Foundation\Http\FormRequest;

class VideoCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'required|string',
            'title' => 'required|string',
            'thumbnail' => 'required|image|mimes:png,jpg,svg,web,jpeg|max:2048',
            'duration' => 'required',
        ];
    }
    public function messages()
    {
        return [

            'description' => (new translate)->translate('Please enter a video description..'),
            'title' => (new translate)->translate('Please enter a video title.'),
            'thumbnail' => (new translate)->translate('Please enter a video thumbnail.'),
            'duration' => (new translate)->translate('Please enter a video duration'),
        ];
    }
}