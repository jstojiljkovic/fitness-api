<?php

namespace App\Http\Controllers\V1;

use App\Helpers\ApplicationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Workout\StoreWorkoutRequest;
use App\Http\Requests\Workout\UpdateWorkoutRequest;
use App\Interfaces\Services\MediaServiceInterface;
use App\Interfaces\Services\WorkoutServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class WorkoutController extends Controller
{
    /**
     * @var WorkoutServiceInterface
     */
    protected WorkoutServiceInterface $workoutService;
    /**
     * @var MediaServiceInterface
     */
    protected MediaServiceInterface $mediaService;

    /**
     * @param WorkoutServiceInterface $workoutService
     */
    public function __construct(WorkoutServiceInterface $workoutService, MediaServiceInterface $mediaService)
    {
        $this->workoutService = $workoutService;
        $this->mediaService = $mediaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $workouts = $this->workoutService->getAll();

        return response()->json([
            'data' => $workouts
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorkoutRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreWorkoutRequest $request): JsonResponse
    {
        $data = $request->validated();
        $photo = $this->mediaService->uploadPhoto($request->photo, ApplicationHelper::activeOrganisation(), true);
        $data = array_merge($data, $photo);
        $workout = $this->workoutService->store($data);

        return response()->json([
            'data' => $workout
        ], Response::HTTP_CREATED);
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
        $workout = $this->workoutService->get($id);

        return response()->json([
            'data' => $workout
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorkoutRequest $request
     * @param string $id
     *
     * @return JsonResponse
     */
    public function update(UpdateWorkoutRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();
        $workout = $this->workoutService->get($id);
        $organisationId = ApplicationHelper::activeOrganisation();

        if ($request->hasFile('photo')) {
            $file = $this->mediaService->overwritePhoto(
                $request->photo,
                $organisationId . '/' . $workout['filename'],
                $organisationId,
                true,
                $organisationId . '/' . $workout['thumbnail'],
            );
            $data = array_merge($data, $file);
        }

        $workout = $this->workoutService->update($id, $data);

        return response()->json([
            'data' => $workout
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
        $workout = $this->workoutService->get($id);
        $organisationId = ApplicationHelper::activeOrganisation();
        $this->workoutService->destroy($id);
        $this->mediaService->deletePhoto(
            $organisationId . '/' . $workout['filename'],
            $organisationId . '/' . $workout['thumbnail']
        );

        return response()->noContent();
    }
}
