<?php

namespace App\Interfaces\Services;

interface AuthServiceInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function getToken(array $data): array;
}
