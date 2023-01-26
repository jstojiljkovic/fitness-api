<?php

namespace App\Repositories;

use App\Http\Resources\VideoResource;
use App\Interfaces\Repositories\VideoRepositoryInterface;
use App\Models\Video;

class EloquentVideoRepository implements VideoRepositoryInterface
{

    /**
     * @return array
     */
    public function getAll(): array
    {
        $videos = Video::all();
        return VideoResource::collection($videos)->resolve();
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        $video = Video::create($data);
        return VideoResource::make($video)->resolve();
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function exists(string $id): bool
    {
        return Video::where('id', $id)->exists();
    }

    /**
     * @param string $id
     *
     * @return array|null
     */
    public function get(string $id): ?array
    {
        $video = Video::find($id);
        return is_null($video) ? null : VideoResource::make($video)->resolve();
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $video = Video::find($id);
        $video->update($data);
        return VideoResource::make($video)->resolve();
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function destroy(string $id): void
    {
        Video::destroy($id);
    }
}
