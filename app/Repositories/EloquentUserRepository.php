<?php

namespace App\Repositories;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepositoryInterface
{

    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data): array
    {
        $data['password'] = Hash::make($data['password']);

        return User::create($data)->toArray();
    }
}
