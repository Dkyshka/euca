<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect(url()->previous());
        }

        return $next($request);
    }
}
