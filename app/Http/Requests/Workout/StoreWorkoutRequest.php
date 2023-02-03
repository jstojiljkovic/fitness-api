<?php

namespace App\Http\Requests\Workout;

use App\Enums\WorkoutIntensityEnum;
use App\Enums\WorkoutLevelEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreWorkoutRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'video_id' => 'required|string|exists:video,id',
            'photo' => 'required|file|image',
            'equipments' => 'sometimes|array|exists:equipment,id',
            'intensity' => ['required', 'numeric', new Enum(WorkoutIntensityEnum::class)],
            'level' => ['required', 'numeric', new Enum(WorkoutLevelEnum::class)],
            'duration' => 'required|numeric'
        ];
    }
}
