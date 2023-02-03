<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkHour\StoreWorkHourRequest;
use App\Http\Requests\WorkHour\UpdateWorkHourRequest;
use App\Interfaces\Services\WorkHourServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class WorkHourController extends Controller
{
    /**
     * @var WorkHourServiceInterface
     */
    protected WorkHourServiceInterface $workHourService;

    /**
     * @param WorkHourServiceInterface $workHourService
     */
    public function __construct(WorkHourServiceInterface $workHourService)
    {
        $this->workHourService = $workHourService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $workHours = $this->workHourService->get();

        return response()->json([
            'data' => $workHours
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorkHourRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreWorkHourRequest $request): JsonResponse
    {
        $workHours = $this->workHourService->store($request->validated()['items']);

        return response()->json([
            'data' => $workHours
        ], Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorkHourRequest $request
     * @param string $id
     *
     * @return JsonResponse
     */
    public function update(UpdateWorkHourRequest $request, string $id): JsonResponse
    {
        $workHours = $this->workHourService->update($id, $request->validated());

        return response()->json([
            'data' => $workHours
        ], Response::HTTP_OK);
    }
}
