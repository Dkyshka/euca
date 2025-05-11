<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class TelegramAuthService
{
    public User $user;

    public function create(int $chat_id, string $name, string $username, string|null $message, bool $lang = true)
    {
        $inviter = null;
        $inviterChatId = trim(str_replace('/start', '', $message));

        if ($inviterChatId) {
            $inviter = User::where('chat_id', $inviterChatId)->first();
        }

        $this->user = User::create([
            'chat_id' => $chat_id,
            'name' => $name,
            'username' => $username,
            'step' => 'language',
            'lang' => 'ru',
            'inviter_id' => $inviter ? $inviter->id : null,
        ]);

        if ($lang) {
            $this->language($this->user->chat_id);
        }
    }

    public function language($chat_id): void
    {
        $keyboard = [
            [
                ['text' => "🇷🇺 Russian"],
                ['text' => "🇺🇿 Uzbek"],
                ['text' => "🇺🇸 English"],
            ],
        ];

        $message = __('lang.Выберите язык:');

        (new TelegramSendingService())
            ->sendKeyboard($chat_id, $message, $keyboard);
    }

}