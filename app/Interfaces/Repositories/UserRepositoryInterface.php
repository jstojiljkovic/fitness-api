<?php

namespace App\Interfaces\Repositories;

interface UserRepositoryInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data): array;
}
