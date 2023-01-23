<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Requests\User\LoginUserRequest;
use App\Interfaces\Services\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LoginController
{
    /**
     * @var AuthServiceInterface
     */
    protected AuthServiceInterface $authService;

    /**
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param LoginUserRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $token = $this->authService->getToken($data);

        return response()->json([
            'data' => [],
            'token' => $token,
        ], Response::HTTP_CREATED);
    }
}
