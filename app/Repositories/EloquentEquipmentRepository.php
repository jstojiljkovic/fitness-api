<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BaseRepositoryInterface;
use App\Models\Equipment;

class EloquentEquipmentRepository implements BaseRepositoryInterface
{

    /**
     * @return array
     */
    public function getAll(): array
    {
        return Equipment::all()->toArray();
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        return Equipment::create($data)->toArray();
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function exists(string $id): bool
    {
        return Equipment::where('id', $id)->exists();
    }

    /**
     * @param string $id
     *
     * @return array|null
     */
    public function get(string $id): ?array
    {
        $equipment = Equipment::find($id);

        return is_null($equipment) ? null : $equipment->toArray();
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $equipment = Equipment::find($id);
        $equipment->update($data);

        return $equipment->toArray();
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function destroy(string $id): void
    {
        Equipment::destroy($id);
    }
}
