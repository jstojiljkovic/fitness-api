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
    public function join(string $id): void;

    /**
     * @param string $id
     * @param string $status
     *
     * @return void
     */
    public function changeStatus(string $id, string $status): void;

    /**
     * @param string $date
     * @param string $start
     * @param string $end
     *
     * @return bool
     */
    public function isScheduled(string $date, string $start, string $end): bool;

    /**
     * @param string $id
     *
     * @return bool
     */
    public function isJoined(string $id): bool;

    /**
     * @param string $id
     *
     * @return array
     */
    public function get(string $id): array;

    /**
     * @param string $workoutId
     * @param string $date
     *
     * @return array
     */
    public function getDailyScheduled(string $workoutId, string $date): array;
}
