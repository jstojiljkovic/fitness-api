<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'photo' => 'sometimes|file|image',
            'video' => 'sometimes|file|mimes:mp4,mov,ogg|max:90000',
            'steps' => 'sometimes|array',
            'steps.*.name' => 'required|string',
            'steps.*.description' => 'required|string',
            'steps.*.start' => 'required|numeric|between:0,999999999999.99',
            'steps.*.end' => 'required|numeric|between:0,99999999999999.99',
        ];
    }
}
