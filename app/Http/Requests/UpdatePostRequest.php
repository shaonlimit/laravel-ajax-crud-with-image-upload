<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                'unique:posts,title,' . $this->id
            ],
            'slug' => [
                'required',
                'string',
                'unique:posts,slug,' . $this->id
            ],
            'description' => 'required|string',

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than :max characters.',
            'title.unique' => 'The title has already been taken.',

            'slug.required' => 'The slug field is required.',
            'slug.string' => 'The slug must be a string.',
            'slug.unique' => 'The slug has already been taken.',

            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',

        ];
    }
}
