<?php

namespace App\Services;

use App\Interfaces\Repositories\BaseRepositoryInterface;
use App\Interfaces\Services\BaseServiceInterface;

class EquipmentService implements BaseServiceInterface
{
    /**
     * @var BaseRepositoryInterface
     */
    protected BaseRepositoryInterface $equipmentRepository;

    /**
     * @param BaseRepositoryInterface $equipmentRepository
     */
    public function __construct(BaseRepositoryInterface $equipmentRepository)
    {
        $this->equipmentRepository = $equipmentRepository;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->equipmentRepository->getAll();
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        return $this->equipmentRepository->store($data);
    }

    /**
     * @param string $id
     *
     * @return array|null
     */
    public function get(string $id): ?array
    {
        $this->checkIfEquipmentExists($id);

        return $this->equipmentRepository->get($id);
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $this->checkIfEquipmentExists($id);

        return $this->equipmentRepository->update($id, $data);
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function destroy(string $id): void
    {
        $this->checkIfEquipmentExists($id);

        $this->equipmentRepository->destroy($id);
    }

    /**
     * @param $id
     *
     * @return void
     */
    private function checkIfEquipmentExists($id): void
    {
        abort_unless(
            $this->equipmentRepository->exists($id),
            404,
            'Equipment with the provided id does not exist.'
        );
    }
}
