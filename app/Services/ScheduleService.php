<?php

namespace App\Services;

use App\Interfaces\Repositories\SessionRepositoryInterface;
use App\Interfaces\Repositories\WorkHourRepositoryInterface;
use App\Interfaces\Services\ScheduleServiceInterface;

class ScheduleService implements ScheduleServiceInterface
{

    /**
     * @var SessionRepositoryInterface
     */
    protected SessionRepositoryInterface $sessionRepository;
    /**
     * @var WorkHourRepositoryInterface
     */
    protected WorkHourRepositoryInterface $workHourRepository;

    /**
     * @param SessionRepositoryInterface $sessionRepository
     * @param WorkHourRepositoryInterface $workHourRepository
     */
    public function __construct(SessionRepositoryInterface $sessionRepository, WorkHourRepositoryInterface $workHourRepository)
    {
        $this->sessionRepository = $sessionRepository;
        $this->workHourRepository = $workHourRepository;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function getDailySchedule(string $workoutId, string $date): array
    {
        return $this->sessionRepository->getDailyScheduled($workoutId, $date);
    }
}
