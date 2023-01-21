<?php

namespace App\Services;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\UserServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    protected UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data): array
    {
        return $this->userRepository->create($data);
    }
}
