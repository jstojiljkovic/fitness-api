<?php

namespace App\Repositories;

use App\Http\Resources\WorkHourExceptionResource;
use App\Interfaces\Repositories\WorkHourExceptionRepositoryInterface;
use App\Models\WorkHourException;

class EloquentWorkHourExceptionRepository implements WorkHourExceptionRepositoryInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function getAll(array $data): array
    {
        $workExceptions = WorkHourException::filter($data)->get();

        return WorkHourExceptionResource::collection($workExceptions)->resolve();
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        $workException = WorkHourException::create($data);

        return WorkHourExceptionResource::make($workException)->resolve();
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function exists(string $id): bool
    {
        return WorkHourException::where('id', $id)->exists();
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $workException = WorkHourException::find($id);
        $workException->update($data);

        return WorkHourExceptionResource::make($workException)->resolve();
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function destroy(string $id): void
    {
        WorkHourException::destroy($id);
    }
}
