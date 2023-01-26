<?php

namespace App\Services;

use App\Interfaces\Repositories\VideoRepositoryInterface;
use App\Interfaces\Services\VideoServiceInterface;

class VideoService implements VideoServiceInterface
{
    protected VideoRepositoryInterface $videoRepository;

    /**
     * @param VideoRepositoryInterface $videoRepository
     */
    public function __construct(VideoRepositoryInterface $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->videoRepository->getAll();
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        return $this->videoRepository->store($data);
    }

    /**
     * @param string $id
     *
     * @return array|null
     */
    public function get(string $id): ?array
    {
        $this->checkIfVideoExists($id);
        return $this->videoRepository->get($id);
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $this->checkIfVideoExists($id);
        return $this->videoRepository->update($id, $data);
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function destroy(string $id): void
    {
        $this->checkIfVideoExists($id);
        $this->videoRepository->destroy($id);
    }

    /**
     * @param $id
     *
     * @return void
     */
    private function checkIfVideoExists($id): void
    {
        abort_unless(
            $this->videoRepository->exists($id),
            404,
            'Video with the provided id does not exist.'
        );
    }
}
