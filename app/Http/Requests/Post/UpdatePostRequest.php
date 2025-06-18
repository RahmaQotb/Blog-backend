<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'array'],
            'title.*' => ['required_with:title', 'string'],
            'content' => ['sometimes', 'array'],
            'content.*' => ['required_with:content', 'string'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'slug' => ['sometimes', 'string', 'unique:posts,slug,' . $this->route('post')->id],
        ];
    }
}
