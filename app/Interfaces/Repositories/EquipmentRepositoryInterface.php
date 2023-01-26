<?php

namespace App\Interfaces\Repositories;

interface EquipmentRepositoryInterface
{
    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array;

    /**
     * @param string $id
     *
     * @return bool
     */
    public function exists(string $id): bool;

    /**
     * @param string $id
     *
     * @return array|null
     */
    public function get(string $id): ?array;

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array;

    /**
     * @param string $id
     *
     * @return void
     */
    public function destroy(string $id): void;
}
