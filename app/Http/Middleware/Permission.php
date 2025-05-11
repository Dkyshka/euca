<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Permission
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user_role = auth()->guard('admin')->user()->role->name;

        if (in_array($user_role, $roles)) {
            return abort('403', 'Доступ запрещён');
        }

        return $next($request);
    }
}