<?php

namespace App\Services;

use App\Interfaces\Repositories\WorkHourRepositoryInterface;
use App\Interfaces\Services\WorkHourServiceInterface;

class WorkHourService implements WorkHourServiceInterface
{
    /**
     * @var WorkHourRepositoryInterface
     */
    protected WorkHourRepositoryInterface $workHourRepository;

    /**
     * @param WorkHourRepositoryInterface $workHourRepository
     */
    public function __construct(WorkHourRepositoryInterface $workHourRepository)
    {
        $this->workHourRepository = $workHourRepository;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->workHourRepository->get();
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        abort_unless(
            $this->workHourRepository->created(),
            404,
            'Work-hours are already created'
        );

        return $this->workHourRepository->store($data);
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array
    {
        abort_unless(
            $this->workHourRepository->exists($id),
            404,
            'Work-hour with the provided id does not exist.'
        );

        return $this->workHourRepository->update($id, $data);
    }
}
