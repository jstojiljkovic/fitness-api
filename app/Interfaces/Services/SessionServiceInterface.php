<?php

namespace App\Interfaces\Services;

interface SessionServiceInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function storeIndividual(array $data): array;

    /**
     * @param array $data
     *
     * @return array
     */
    public function storeGroup(array $data): array;

    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param string $id
     *
     * @return void
     */
    public function joinGroup(string $id): void;
}
