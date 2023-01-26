<?php

namespace App\Services;

use App\Interfaces\Services\MediaServiceInterface;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Component\HttpFoundation\File\File as IlluminateFile;

class MediaService implements MediaServiceInterface
{
    protected Filesystem $storage;

    public function __construct()
    {
        $this->storage = Storage::disk(env('MEDIA_DIST', 'local'));
    }

    /**
     * @param UploadedFile $file
     * @param string $oldPath
     * @param string $oldThumbnailPath
     * @param string $newPath
     * @param bool $withThumbnail
     *
     * @return array
     */
    public function overwritePhoto(UploadedFile $file, string $oldPath, string $newPath, bool $withThumbnail = false, string $oldThumbnailPath = ''): array
    {
        $this->deletePhoto($oldPath, $oldThumbnailPath);
        return $this->uploadPhoto($file, $newPath, $withThumbnail);
    }

    /**
     * @param string $path
     * @param string $thumbnailPath
     *
     * @return void
     */
    public function deletePhoto(string $path, string $thumbnailPath = ''): void
    {
        $this->storage->delete($path);

        if (isset($thumbnailPath)) {
            $this->storage->delete($thumbnailPath);
        }
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     * @param bool $withThumbnail
     *
     * @return array
     */
    public function uploadPhoto(UploadedFile $file, string $path, bool $withThumbnail = false): array
    {
        $name = $this->upload($file, $path);

        if ($withThumbnail) {
            $thumbnail = $this->uploadThumbnail($file, 'preview_' . $name, $path);
        }

        return [
            'filename' => $name,
            'thumbnail' => $thumbnail ?? null
        ];
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return string
     */
    private function upload(UploadedFile $file, string $path): string
    {
        $uniqueId = uniqid('', true);
        $name = $uniqueId . '_' . $file->getClientOriginalName();

        $this->storage->putFileAs(
            $path,
            new IlluminateFile($file),
            $name,
        );

        return $name;
    }

    /**
     * @param UploadedFile $file
     * @param string $filename
     * @param string $path
     *
     * @return string
     */
    private function uploadThumbnail(UploadedFile $file, string $filename, string $path): string
    {
        $thumbnail = Image::make($file);

        $thumbnail->resize(
            env('MEDIA_THUMBNAIL_WIDTH', 360),
            env('MEDIA_THUMBNAIL_HEIGHT', 203),
            function ($constraint) {
                $constraint->aspectRatio();
            });

        $this->storage->put($path . '/' . $filename, $thumbnail->encode());

        return $filename;
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return array
     */
    public function uploadVideo(UploadedFile $file, string $path): array
    {
        return [
            'source' => $this->upload($file, $path)
        ];
    }

    /**
     * @param string $path
     *
     * @return void
     */
    public function deleteVideo(string $path): void
    {
        $this->storage->delete($path);
    }

    /**
     * @param UploadedFile $file
     * @param string $oldPath
     * @param string $newPath
     *
     * @return array
     */
    public function overwriteVideo(UploadedFile $file, string $oldPath, string $newPath): array
    {
        $this->deleteVideo($oldPath);
        return $this->uploadVideo($file, $newPath);
    }
}
