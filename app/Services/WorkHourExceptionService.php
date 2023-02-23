<?php

namespace App\Services;

use App\Interfaces\Repositories\WorkHourExceptionRepositoryInterface;
use App\Interfaces\Services\WorkHourExceptionServiceInterface;

class WorkHourExceptionService implements WorkHourExceptionServiceInterface
{
    /**
     * @var WorkHourExceptionRepositoryInterface
     */
    protected WorkHourExceptionRepositoryInterface $workHourExceptionRepository;

    /**
     * @param WorkHourExceptionRepositoryInterface $workHourExceptionRepository
     */
    public function __construct(WorkHourExceptionRepositoryInterface $workHourExceptionRepository)
    {
        $this->workHourExceptionRepository = $workHourExceptionRepository;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function getAll(array $data): array
    {
        return $this->workHourExceptionRepository->getAll($data);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        return $this->workHourExceptionRepository->store($data);
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $this->checkIfWorkExceptionExists($id);

        return $this->workHourExceptionRepository->update($id, $data);
    }

    /**
     * @param string $id
     *
     * @return void
     */
    private function checkIfWorkExceptionExists(string $id): void
    {
        abort_unless(
            $this->workHourExceptionRepository->exists($id),
            404,
            'Work-hour exception with the provided id does not exist.'
        );
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function destroy(string $id): void
    {
        $this->checkIfWorkExceptionExists($id);

        $this->workHourExceptionRepository->destroy($id);
    }
}
