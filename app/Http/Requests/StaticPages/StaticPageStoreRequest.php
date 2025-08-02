<?php

namespace App\Http\Requests\StaticPages;

use Illuminate\Foundation\Http\FormRequest;

class StaticPageStoreRequest extends FormRequest
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
            'title' => 'required|unique:static_pages,title',
            'slug' => 'nullable|unique:static_pages,slug',
            'content' => 'required',
            'is_published' => 'boolean',
        ];
    }
}
