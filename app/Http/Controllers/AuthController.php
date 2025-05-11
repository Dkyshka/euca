<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function auth(UserAuthRequest $userAuthRequest): \Illuminate\Http\JsonResponse
    {
        $remember = $userAuthRequest->has('remember');

        if(auth()->attempt([
            'login' => $userAuthRequest->input('login'),
            'password' => $userAuthRequest->input('password')
        ], $remember)) {
            return response()->json([
                'success' => true,
                'redirect_url' => url(app()->getLocale()),
            ]);
        }

        return response()->json([
            'error' => 'Неверный логин или пароль',
        ], 401);
    }

    public function store(UserRegisterRequest $userRegisterRequest): \Illuminate\Http\JsonResponse
    {
        try {
            $user = User::create($userRegisterRequest->validated());
            auth()->login($user);

            return response()->json([
                'success' => true,
                'redirect_url' => url(app()->getLocale())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Произошла ошибка',
            ], 500);
        }
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect(url(app()->getLocale()));
    }
}
