<?php

namespace App\Http\Requests\Workout;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkoutRequest extends FormRequest
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
            'video_id' => 'sometimes|string|exists:video,id',
            'photo' => 'sometimes|file|image',
            'equipments' => 'sometimes|array|exists:equipment,id',
        ];
    }
}
