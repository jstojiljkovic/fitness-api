<?php

namespace App\Interfaces\Services;

interface AuthServiceInterface
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function getToken(array $data): string;
}
