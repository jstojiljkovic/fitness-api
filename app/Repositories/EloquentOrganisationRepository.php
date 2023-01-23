<?php

namespace App\Repositories;

use App\Interfaces\Repositories\OrganisationRepositoryInterface;
use App\Models\Organisation;

class EloquentOrganisationRepository implements OrganisationRepositoryInterface
{
    /**
     * @return array
     */
    public function getAll(): array
    {
        return Organisation::all()->toArray();
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        return Organisation::create($data)->toArray();
    }

    /**
     * @param string $id
     *
     * @return array|null
     */
    public function get(string $id): ?array
    {
        $organisation = Organisation::find($id);

        return is_null($organisation) ? null : $organisation->toArray();
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $organisation = Organisation::find($id);
        $organisation->update($data);

        return $organisation->toArray();
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function destroy(string $id): void
    {
        Organisation::destroy($id);
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function exists(string $id): bool
    {
        return Organisation::where('id', $id)->exists();
    }
}
