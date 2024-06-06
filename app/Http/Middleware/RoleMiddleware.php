<?php

namespace App\Http\Middleware;

use App\Helpers\UserRoleHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{

    protected $userRoleHelper;

    public function __construct(UserRoleHelper $userRoleHelper)
    {
        $this->userRoleHelper = $userRoleHelper;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role = 'admin'): Response
    {
        if (! $request->user() || ! $this->userRoleHelper->checkRole($request->user()->id, $role)) {
            abort(403, 'Unauthorized action for '. $role);
        }
        return $next($request);
    }
}
