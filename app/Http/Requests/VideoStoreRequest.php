<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class VideoStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'length' => ['required', 'integer'],
            'slug' => ['required', 'unique:videos,slug', 'alpha_dash'],
            'file' => ['required' , 'file', 'mimetypes:video/mp4'],
            'thumbnail' => ['required', 'url'],
            'category_id' => ['required','exists:categories,id']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
        'slug' => Str::slug($this->slug),
        ]);
    }

    public function messages()
    {
        return [
            'file.mimetypes' => 'فایل باید ویدئویی و از نوع MP4 باشد.'
        ];
    }
}
