<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (\Illuminate\Http\Response|RedirectResponse) $next
     *
     * @return \Illuminate\Http\Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): \Illuminate\Http\Response|RedirectResponse
    {
        abort_unless(
            Auth()->user()->role === Role::ADMIN,
            Response::HTTP_FORBIDDEN,
            'You dont have correct permission to access this.'
        );

        return $next($request);
    }
}
