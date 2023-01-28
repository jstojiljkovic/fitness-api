<?php

namespace App\Repositories;

use App\Http\Resources\WorkoutResource;
use App\Interfaces\Repositories\WorkoutRepositoryInterface;
use App\Models\Workout;

class EloquentWorkoutRepository implements WorkoutRepositoryInterface
{

    /**
     * @return array
     */
    public function getAll(): array
    {
        $workouts = Workout::all();
        return WorkoutResource::collection($workouts)->resolve();
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        $workout = Workout::create($data);
        if (isset($data['equipments'])) {
            $workout->equipments()->sync($data['equipments']);
        }

        return WorkoutResource::make($workout)->resolve();
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function exists(string $id): bool
    {
        return Workout::where('id', $id)->exists();
    }

    /**
     * @param string $id
     *
     * @return array|null
     */
    public function get(string $id): ?array
    {
        $workout = Workout::find($id);
        return is_null($workout) ? null : WorkoutResource::make($workout)->resolve();
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $workout = Workout::find($id);
        $workout->update($data);
        if (isset($data['equipments'])) {
            $workout->equipments()->sync($data['equipments']);
        }

        return WorkoutResource::make($workout)->resolve();
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function destroy(string $id): void
    {
        Workout::destroy($id);
    }
}
