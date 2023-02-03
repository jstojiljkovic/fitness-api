<?php

namespace App\Http\Resources;

use App\Constants\WorkHourConstant;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class WorkHourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'day' => WorkHourConstant::DAYS_IN_ENGLISH[$this->day],
            'start' => $this->start,
            'end' => $this->end,
            'available' => $this->available
        ];
    }
}
