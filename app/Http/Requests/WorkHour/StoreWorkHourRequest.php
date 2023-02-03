<?php

namespace App\Http\Requests\WorkHour;

use App\Constants\WorkHourConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWorkHourRequest extends FormRequest
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
            'items' => 'required|array|min:7|max:7',
            'items.*.day' => ['required', 'integer', Rule::in(WorkHourConstant::DAYS_IN_WEEK)],
            'items.*.start' => 'required|date_format:H:i',
            'items.*.end' => 'required|date_format:H:i',
            'items.*.available' => 'sometimes|integer',
        ];
    }
}
