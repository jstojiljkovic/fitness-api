<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Session\JoinSessionRequest;
use App\Http\Requests\Session\StoreSessionRequest;
use App\Interfaces\Services\SessionServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SessionController extends Controller
{
    protected SessionServiceInterface $sessionService;

    /**
     * @param SessionServiceInterface $sessionService
     */
    public function __construct(SessionServiceInterface $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $sessions = $this->sessionService->getAll();

        return response()->json([
            'data' => $sessions
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSessionRequest $request
     *
     * @return JsonResponse
     */
    public function storeIndividual(StoreSessionRequest $request): JsonResponse
    {
        $session = $this->sessionService->storeIndividual($request->validated());

        return response()->json([
            'data' => $session
        ], Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSessionRequest $request
     *
     * @return JsonResponse
     */
    public function storeGroup(StoreSessionRequest $request): JsonResponse
    {
        $session = $this->sessionService->storeGroup($request->validated());

        return response()->json([
            'data' => $session
        ], Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JoinSessionRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function joinGroup(JoinSessionRequest $request): \Illuminate\Http\Response
    {
        $this->sessionService->joinGroup($request->validated()['id']);

        return response()->noContent();
    }
}
