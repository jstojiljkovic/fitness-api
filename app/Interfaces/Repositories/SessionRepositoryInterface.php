<?php

namespace App\Interfaces\Repositories;

interface SessionRepositoryInterface
{
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

    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @return array
     */
    public function getJoined(): array;

    /**
     * @return array
     */
    public function getOwned(): array;

    /**
     * @param string $id
     *
     * @return void
     */
    public function joinGroup(string $id): void;

    /**
     * @param string $id
     * @param string $status
     *
     * @return void
     */
    public function changeStatus(string $id, string $status): void;
}
