<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Roles;

class RoleValidateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $feature): Response
    {
        $roleId = auth()->user()->role_id;
        $roles = Roles::find($roleId);
        $permission = json_decode($roles->permission, 1);
        $feature = explode('_', $feature, 2);

        if (!array_key_exists(strtolower($feature[0]), $permission)) {
            return Redirect(route('dashboard'));
        }

        if (isset($feature[1]) && !in_array(strtolower($feature[1]), $permission[$feature[0]])) {
            return Redirect(route('dashboard'));
        }

        return $next($request);
    }
}
