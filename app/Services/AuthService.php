<?php

namespace App\Services;

use App\Interfaces\Services\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthService implements AuthServiceInterface
{

    /**
     * @param array $data
     *
     * @return array
     */
    public function getToken(array $data): array
    {
        if (Auth::attempt($data)) {
            $token = Auth::user()->createToken('graphene');

            return [
                'access_token' => $token->accessToken,
                'token_type' => 'bearer',
                'expires_in' => $token->token->expires_at->timestamp
            ];
        }

        abort(Response::HTTP_UNAUTHORIZED, 'Unauthorised');
    }
}
