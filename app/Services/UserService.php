<?php

namespace App\Services;

use App\Interfaces\Repositories\OrganisationRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\OrganisationServiceInterface;
use App\Interfaces\Services\UserServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    protected UserRepositoryInterface $userRepository;

    protected OrganisationRepositoryInterface $organisationRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, OrganisationRepositoryInterface $organisationRepository)
    {
        $this->userRepository = $userRepository;
        $this->organisationRepository = $organisationRepository;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data): array
    {
        abort_unless(
            $this->organisationRepository->exists($data['organisation_id']),
            404,
            'Organisation with the provided id does not exist.'
        );

        return $this->userRepository->create($data);
    }
}
