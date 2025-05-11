<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        if (in_array($locale, ['ru', 'uz', 'en'])) {
            app()->setLocale($locale);

            session()->put('locale', app()->getLocale());
        } else {
            return redirect(session('locale') ?
                session('locale') . $request->getRequestUri()
                : app()->getLocale() . $request->getRequestUri());
        }

        return $next($request);
    }
}
