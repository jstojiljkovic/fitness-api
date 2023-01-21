<?php

namespace App\Interfaces\Services;

interface UserServiceInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data): array;
}
