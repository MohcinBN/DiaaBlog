<?php

namespace App\Http\Requests\StaticPages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaticPageUpdateRequest extends FormRequest
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
                Rule::unique('static_pages', 'title')->ignore($this->route('static_page'))
            ],
            'slug' => [
                'nullable',
                Rule::unique('static_pages', 'slug')->ignore($this->route('static_page'))
            ],
            'content' => 'required',
            'is_published' => 'boolean',
        ];
    }
}
