<?php

namespace App\Services;

use App\Interfaces\Services\BaseServiceInterface;

class OrganisationService implements BaseServiceInterface
{

    /**
     * @var BaseServiceInterface
     */
    protected BaseServiceInterface $organisationRepository;

    /**
     * @param BaseServiceInterface $organisationRepository
     */
    public function __construct(BaseServiceInterface $organisationRepository)
    {
        $this->organisationRepository = $organisationRepository;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->organisationRepository->getAll();
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        return $this->organisationRepository->store($data);
    }

    /**
     * @param string $id
     *
     * @return array|null
     */
    public function get(string $id): ?array
    {
        return $this->organisationRepository->get($id);
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $this->checkIfOrganisationExists($id);

        return $this->organisationRepository->update($id, $data);
    }

    /**
     * @param $id
     *
     * @return void
     */
    private function checkIfOrganisationExists($id): void
    {
        abort_unless(
            $this->organisationRepository->exists($id),
            404,
            'Organisation with the provided id does not exist.'
        );
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function destroy(string $id): void
    {
        $this->checkIfOrganisationExists($id);

        $this->organisationRepository->destroy($id);
    }
}
