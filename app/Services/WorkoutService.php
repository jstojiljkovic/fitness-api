<?php

namespace App\Services;

use App\Interfaces\Repositories\WorkoutRepositoryInterface;
use App\Interfaces\Services\WorkoutServiceInterface;

class WorkoutService implements WorkoutServiceInterface
{
    /**
     * @var WorkoutRepositoryInterface
     */
    protected WorkoutRepositoryInterface $workoutRepository;

    /**
     * @param WorkoutRepositoryInterface $workoutRepository
     */
    public function __construct(WorkoutRepositoryInterface $workoutRepository)
    {
        $this->workoutRepository = $workoutRepository;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->workoutRepository->getAll();
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        return $this->workoutRepository->store($data);
    }

    /**
     * @param string $id
     *
     * @return array|null
     */
    public function get(string $id): ?array
    {
        $this->checkIfWorkoutExists($id);
        return $this->workoutRepository->get($id);
    }

    /**
     * @param string $id
     *
     * @return void
     */
    private function checkIfWorkoutExists(string $id): void
    {
        abort_unless(
            $this->workoutRepository->exists($id),
            404,
            'Workout with the provided id does not exist.'
        );
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $this->checkIfWorkoutExists($id);
        return $this->workoutRepository->update($id, $data);
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function destroy(string $id): void
    {
        $this->checkIfWorkoutExists($id);
        $this->workoutRepository->destroy($id);
    }
}
