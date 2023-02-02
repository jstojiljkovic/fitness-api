<?php

namespace App\Http\Requests\Workout;

use App\Enums\WorkoutIntensityEnum;
use App\Enums\WorkoutLevelEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

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
            'intensity' => ['sometimes', 'numeric', new Enum(WorkoutIntensityEnum::class)],
            'level' => ['sometimes', 'numeric', new Enum(WorkoutLevelEnum::class)],
            'duration' => 'sometimes|numeric'
        ];
    }
}
