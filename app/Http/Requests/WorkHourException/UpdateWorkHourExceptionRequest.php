<?php

namespace App\Http\Requests\WorkHourException;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkHourExceptionRequest extends FormRequest
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
            'date' => 'sometimes|date_format:Y-m-d',
            'start' => 'sometimes|date_format:H:i',
            'end' => 'sometimes|date_format:H:i',
        ];
    }
}
