<?php

namespace App\Services;

use App\Helpers\TextFormatterHelper;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class TelegramMessageService
{
    public User|null $user;
    public string $lang = 'ru';
    public Setting $setting;

    public function __construct($chat_id)
    {
        $this->user = User::where('chat_id', $chat_id)->first();
        $this->setting = Setting::find(1);
        app()->setLocale($this->user->lang);
        session()->put('locale', $this->user->lang);
    }

    public function hendle($message): void
    {
        $step = $this->user->step;

        if ($step == 'main' && (str_starts_with($message, '/start'))) {
            if ($this->user->is_confirm) {
                $this->main();
            } else {
                $this->offer();
            }
        }

        if ($message === '🇺🇿 Uzbek' || $message === '🇺🇸 English' || $message === '🇷🇺 Russian') {
            if ($message === '🇺🇿 Uzbek') {
                $this->lang = 'uz';
            } else if ($message === '🇺🇸 English') {
                $this->lang = 'en';
            }

            $this->user->update([
                'lang' => $this->lang,
                'step' => 'main'
            ]);

            app()->setLocale($this->lang);

            session()->put('locale', app()->getLocale());

            if ($this->user->is_confirm) {
                $this->main();
            } else {
                $this->offer();
            }

        }
    }

    public function main(): void
    {
        $keyboard = [
            [
                [
                    'text' => '🔍 '. __('lang.Запустить бот'),
                    'web_app' => [
                        'url' => env('APP_URL'),
                    ],
                ],
            ],
            [
                [
                    'text' => '🌐 '. __('lang.Сменить язык'),
                    'callback_data' => 'change_lang'
                ],
            ],
        ];

        $localizedMessage = isset($this->setting->markup['start'][$this->user->lang]) ?
            $this->setting->markup['start'][$this->user->lang] : 'Empty';

        $localizedMessage = TextFormatterHelper::formatForTelegram($localizedMessage);
        (new TelegramSendingService())->sendInlineKeyboard($this->user->chat_id, $localizedMessage, $keyboard);
    }

    public function offer(): void
    {
        $pdfPath = isset($this->setting->markup['public_offer'][$this->lang]) ?
            $this->setting->markup['public_offer'][$this->lang] : null;

        $keyboard = [
            [
                ['text' => __('lang.Публичная офёрта'), 'url' => asset($pdfPath)],
            ],
            [
                ['text' => '✅ '. __('lang.Согласен'), 'callback_data' => 'confirm'],
            ],
        ];

        $localizedMessage = !empty($this->setting->markup['desc_offer'][$this->lang]) ?
            $this->setting->markup['desc_offer'][$this->lang] :  __('lang.Ознакомтесь с офёртой');

        $localizedMessage = TextFormatterHelper::formatForTelegram($localizedMessage);

        (new TelegramSendingService())->sendInlineKeyboard($this->user->chat_id, $localizedMessage, $keyboard);
    }
}