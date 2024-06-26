<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreVideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'slug' => ['required', 'unique:videos,slug', 'alpha_dash'],
            'category_id' => ['required', 'exists:categories,id'],
            'file' => ['required', 'file', 'mimetypes:video/mp4']
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug),
        ]);
    }

    public function messages()
    {
        return [
            'file.*' => 'فایل باید ویدیویی باشد.'
        ];
    }
}

