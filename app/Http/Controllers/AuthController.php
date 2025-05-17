<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Mail\EmailVerificationCode;
use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
            DB::beginTransaction();
            $user = User::create($userRegisterRequest->validated());

            // Генерируем 6-значный код
//            $code = rand(100000, 999999);
//
//            // Сохраняем код в email_verification_codes
//            DB::table('email_verification_codes')->updateOrInsert(
//                ['email' => $user->email],
//                [
//                    'code' => $code,
//                    'expires_at' => now()->addMinutes(10),
//                    'updated_at' => now(),
//                    'created_at' => now(),
//                ]
//            );
//
//            // Отправляем код по email
//            Mail::to($user->email)->send(new EmailVerificationCode($code));
//
//            DB::commit();
//            return response()->json([
//                'success' => true,
//                'message' => 'Код подтверждения отправлен на почту',
//            ]);

            auth()->login($user);

            return response()->json([
                'success' => true,
                'redirect_url' => url(app()->getLocale())
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Произошла ошибка'. $e->getMessage(),
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

    public function verifyCode(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6'
        ]);

        $record = DB::table('email_verification_codes')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return response()->json(['error' => 'Код неверный или истёк'], 422);
        }

        // Активируем пользователя, можно логинить:
        $user = User::where('email', $request->email)->first();
        $user->email_verified_at = now();
        $user->save();

        DB::table('email_verification_codes')->where('email', $request->email)->delete();

        auth()->login($user);

        return response()->json(['success' => true, 'redirect_url' => url(app()->getLocale())]);
    }

    public function resendCode(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $code = rand(100000, 999999);

        DB::table('email_verification_codes')->updateOrInsert(
            ['email' => $request->email],
            [
                'code' => $code,
                'expires_at' => now()->addMinutes(10),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        Mail::to($request->email)->send(new EmailVerificationCode($code));

        return response()->json(['success' => true]);
    }
}
