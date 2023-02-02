<?php

namespace App\Interfaces\Repositories;

interface WorkHourRepositoryInterface
{
    /**
     * @return array
     */
    public function get(): array;

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
     * @return bool
     */
    public function created(): bool;

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array;
}
