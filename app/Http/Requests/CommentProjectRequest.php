<?php

namespace App\Http\Requests;

use App\utils\translate;
use Illuminate\Foundation\Http\FormRequest;

class CommentProjectRequest extends FormRequest
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
            'file' => 'nullable|mimes:png,jpg,jpeg,mp4,mov,avi,svg,webp',
            'comment' => 'required|string'
        ];
    }
    public function messages()
    {
        return [
            'file' => (new translate)->translate('Please enter the video or image in the following formats:png,jpg,mp4'),
            'comment' => (new translate)->translate('Please enter a comment.'),
        ];
    }
}
