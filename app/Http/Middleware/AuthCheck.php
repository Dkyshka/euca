<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\TelegramAuthService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $data = json_decode($request->getContent());
            $callback = $data?->callback_query ?? null;
            $chat_id = $callback ? $callback->from->id : ($data->message?->chat?->id ?? null);
            $name = $callback ? $callback->from->first_name : ($data->message?->chat?->first_name ?? null);
            $username = $callback ? $callback->from->username : ($data->message?->chat?->username ?? null);
            $message = $data?->message?->text ?? null;

//            Storage::append('in/123.txt', json_encode($data));

            if (!$chat_id) {
                Log::warning('Chat ID не найден в запросе');
                return response()->json(['error' => 'Chat ID не найден'], 400); // Верните ошибку, если chat_id не найден
            }

            $user = User::where('chat_id', $chat_id)
                ->first();

            if (!$user && str_starts_with($message, '/start')) {
                (new TelegramAuthService())->create($chat_id, $name, $username, $message);
                return response()->json(['message' => 'User created'], 200); // Возвращаем ответ, если пользователь создается
            }

            if (!$user && $callback) {
                (new TelegramAuthService())->create($chat_id, $name, $username, $message, lang: false);
            }

            return $next($request);
        } catch (\Exception $e) {
            Log::error('Ошибка аутентификации: ' . $e->getMessage());
            return response()->json(['error' => 'Authentication error'], 500); // Вернуть ошибку, если что-то пошло не так
        }
    }
}
