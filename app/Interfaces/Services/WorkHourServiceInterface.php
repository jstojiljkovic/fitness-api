<?php

namespace App\Interfaces\Services;

interface WorkHourServiceInterface
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
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array;
}
