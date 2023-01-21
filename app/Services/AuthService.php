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
     * @return string
     */
    public function getToken(array $data): string
    {
        if (Auth::attempt($data)) {
            return Auth::user()->createToken('graphene')->accessToken;
        }

        abort(Response::HTTP_UNAUTHORIZED, 'Unauthorised');
    }
}
