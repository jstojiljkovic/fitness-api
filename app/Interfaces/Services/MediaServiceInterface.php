<?php

namespace App\Interfaces\Services;

use Illuminate\Http\UploadedFile;

interface MediaServiceInterface
{
    /**
     * @param UploadedFile $file
     * @param string $path
     * @param bool $withThumbnail
     *
     * @return array
     */
    public function uploadPhoto(UploadedFile $file, string $path, bool $withThumbnail = false): array;

    /**
     * @param string $path
     * @param string $thumbnailPath
     *
     * @return void
     */
    public function deletePhoto(string $path, string $thumbnailPath = ''): void;

    /**
     * @param UploadedFile $file
     * @param string $oldPath
     * @param string $oldThumbnailPath
     * @param string $newPath
     * @param bool $withThumbnail
     *
     * @return array
     */
    public function overwritePhoto(UploadedFile $file, string $oldPath, string $newPath, bool $withThumbnail = false, string $oldThumbnailPath = ''): array;

    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return string
     */
    public function uploadVideo(UploadedFile $file, string $path): array;

    /**
     * @param string $path
     *
     * @return void
     */
    public function deleteVideo(string $path): void;

	/**
	 * @param UploadedFile $file
	 * @param string $oldPath
	 * @param string $newPath
	 *
	 * @return array
	 */
	public function overwriteVideo(UploadedFile $file, string $oldPath, string $newPath):array ;
}
