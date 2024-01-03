<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $routeName = $this->route()->getName();
        return [
            'title' => 'required',
            'prefix_title' => 'nullable',
            'suffix_title' => 'nullable',
            'type' => 'nullable|in:0,1',
            'image' => 'nullable|image|max:2048|mimes:jpeg,jpg,bmp,png',
            'video_url' => 'nullable',
            'url' => 'nullable',
            'description' => 'nullable',
            'button_text' => 'nullable',
            'status' => 'nullable',
            'show_button' => 'nullable|in:0,1',
            'show_title' => 'nullable|in:0,1',
            'show_description' => 'nullable|in:0,1',
            'show_prefix_title' => 'nullable|in:0,1',
            'show_suffix_title' => 'nullable|in:0,1',
            'target' => 'nullable|in:0,1',
        ];
    }
    public function messages()
    {
        return [
            'image.required_if' => ':attribute is required',
            'video_url.required_if' => ':attribute is required',
        ];
    }
}
