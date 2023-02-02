<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (\Illuminate\Http\Response|RedirectResponse) $next
     *
     * @return \Illuminate\Http\Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $role = Auth()->user()->role;
        abort_unless(
            $role === RoleEnum::EMPLOYEE || $role === RoleEnum::ADMIN,
            Response::HTTP_FORBIDDEN,
            'You dont have correct permission to access this.'
        );

        return $next($request);
    }
}
