<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VideoUpdateRequest extends VideoStoreRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'slug' => ['required', Rule::unique('videos')->ignore($this->video)]
        ]);
    }
}
