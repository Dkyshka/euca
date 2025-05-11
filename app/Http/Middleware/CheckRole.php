<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (auth()->user()->role->name == 'user') {
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withInput()->withErrors(['error' => 'Доступ запрещён']);
        }

        return $next($request);
    }
}
