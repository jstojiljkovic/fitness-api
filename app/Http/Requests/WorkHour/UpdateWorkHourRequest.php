<?php

namespace App\Http\Requests\WorkHour;

use App\Constants\WorkHourConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWorkHourRequest extends FormRequest
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
            'start' => 'sometimes|date_format:H:i',
            'end' => 'sometimes|date_format:H:i',
            'available' => 'sometimes|integer',
        ];
    }
}
