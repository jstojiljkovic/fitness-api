<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use JsonSerializable;

class ScheduledBlockResource extends JsonResource
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
        $startTime = Carbon::createFromTimeString($this->start);
        $endTime = Carbon::createFromTimeString($this->end);
        $minutes = $endTime->diffInMinutes($startTime);

        return [
            'startHour' => $startTime->hour,
            'startMinute' => $startTime->minute,
            'duration' => $minutes
        ];
    }
}
