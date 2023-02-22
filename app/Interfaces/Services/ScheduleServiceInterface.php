<?php

namespace App\Interfaces\Services;

interface ScheduleServiceInterface
{
    /**
     * @param string $workoutId
     * @param string $date
     *
     * @return array
     */
    public function getDailySchedule(string $workoutId, string $date): array;
}
