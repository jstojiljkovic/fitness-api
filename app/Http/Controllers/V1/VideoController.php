<?php

namespace App\Http\Controllers\V1;

use App\Helpers\ApplicationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Video\StoreVideoRequest;
use App\Http\Requests\Video\UpdateVideoRequest;
use App\Interfaces\Services\MediaServiceInterface;
use App\Interfaces\Services\VideoServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class VideoController extends Controller
{
    /**
     * @var VideoServiceInterface
     */
    protected VideoServiceInterface $videoService;
    /**
     * @var MediaServiceInterface
     */
    protected MediaServiceInterface $mediaService;

    /**
     * @param VideoServiceInterface $videoService
     * @param MediaServiceInterface $mediaService
     */
    public function __construct(VideoServiceInterface $videoService, MediaServiceInterface $mediaService)
    {
        $this->videoService = $videoService;
        $this->mediaService = $mediaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $videos = $this->videoService->getAll();

        return response()->json([
            'data' => $videos
        ], Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreVideoRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreVideoRequest $request): JsonResponse
    {
        $data = $request->validated();
        $photo = $this->mediaService->uploadPhoto($request->photo, ApplicationHelper::activeOrganisation(), true);
        $video = $this->mediaService->uploadVideo($request->video, ApplicationHelper::activeOrganisation());
        $data = array_merge($data, $photo, $video);
        $video = $this->videoService->store($data);

        return response()->json([
            'data' => $video
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     *
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $video = $this->videoService->get($id);

        return response()->json([
            'data' => $video
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateVideoRequest $request
     * @param string $id
     *
     * @return JsonResponse
     */
    public function update(UpdateVideoRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();
        $video = $this->videoService->get($id);
        $organisationId = ApplicationHelper::activeOrganisation();

        if ($request->hasFile('photo')) {
            $file = $this->mediaService->overwritePhoto(
                $request->photo,
                $organisationId . '/' . $video['filename'],
                $organisationId,
                true,
                $organisationId . '/' . $video['thumbnail'],
            );
            $data = array_merge($data, $file);
        }

        if ($request->hasFile('video')) {
            $file = $this->mediaService->overwriteVideo(
                $request->video,
                $organisationId . '/' . $video['source'],
                $organisationId,
            );
            $data = array_merge($data, $file);
        }

        $video = $this->videoService->update($id, $data);

        return response()->json([
            'data' => $video
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     *
     * @return Response
     */
    public function destroy(string $id): Response
    {
        $video = $this->videoService->get($id);
        $organisationId = ApplicationHelper::activeOrganisation();
        $this->videoService->destroy($id);
        $this->mediaService->deletePhoto(
            $organisationId . '/' . $video['filename'],
            $organisationId . '/' . $video['thumbnail']
        );
        $this->mediaService->deleteVideo(
            $organisationId . '/' . $video['source']
        );

        return response()->noContent();
    }
}
