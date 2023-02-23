<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkHourException\GetWorkHourExceptionRequest;
use App\Http\Requests\WorkHourException\StoreWorkHourExceptionRequest;
use App\Http\Requests\WorkHourException\UpdateWorkHourExceptionRequest;
use App\Interfaces\Services\WorkHourExceptionServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class WorkHourExceptionController extends Controller
{
    /**
     * @var WorkHourExceptionServiceInterface
     */
    protected WorkHourExceptionServiceInterface $workHourExceptionService;

    /**
     * @param WorkHourExceptionServiceInterface $workHourExceptionService
     */
    public function __construct(WorkHourExceptionServiceInterface $workHourExceptionService)
    {
        $this->workHourExceptionService = $workHourExceptionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(GetWorkHourExceptionRequest $request): JsonResponse
    {
        $workExceptions = $this->workHourExceptionService->getAll($request->validated());

        return response()->json([
            'data' => $workExceptions
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorkHourExceptionRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreWorkHourExceptionRequest $request): JsonResponse
    {
        $workException = $this->workHourExceptionService->store($request->validated());

        return response()->json([
            'data' => $workException
        ], Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorkHourExceptionRequest $request
     * @param string $id
     *
     * @return JsonResponse
     */
    public function update(UpdateWorkHourExceptionRequest $request, string $id): JsonResponse
    {
        $workException = $this->workHourExceptionService->update($id, $request->validated());

        return response()->json([
            'data' => $workException
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
        $this->workHourExceptionService->destroy($id);

        return response()->noContent();
    }
}
