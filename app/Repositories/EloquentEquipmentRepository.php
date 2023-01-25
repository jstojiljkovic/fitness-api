<?php

namespace App\Repositories;

use App\Http\Resources\EquipmentResource;
use App\Interfaces\Repositories\BaseRepositoryInterface;
use App\Models\Equipment;

class EloquentEquipmentRepository implements BaseRepositoryInterface
{

    /**
     * @return array
     */
    public function getAll(): array
    {
        $equipments = Equipment::all();
        return EquipmentResource::collection($equipments)->resolve();
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        $equipment = Equipment::create($data);
        return EquipmentResource::make($equipment)->resolve();
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

        return is_null($equipment) ? null : EquipmentResource::make($equipment)->resolve();
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

        return EquipmentResource::make($equipment)->resolve();
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
