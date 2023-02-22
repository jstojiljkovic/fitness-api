<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Schedule\DailyScheduleRequest;
use App\Interfaces\Services\ScheduleServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ScheduleController extends Controller
{
    protected ScheduleServiceInterface $scheduleService;

    /**
     * @param ScheduleServiceInterface $scheduleService
     */
    public function __construct(ScheduleServiceInterface $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    /**
     * @param DailyScheduleRequest $request
     *
     * @return JsonResponse
     */
    public function getDailySchedule(DailyScheduleRequest $request): JsonResponse
    {
        $scheduled = $this->scheduleService->getDailySchedule($request->validated());

        return response()->json([
            'data' => $scheduled
        ], Response::HTTP_OK);
    }
}
