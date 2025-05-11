<?php

namespace App\Services;

use App\Models\Inquiry;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class TelegramCallbackService
{
    public User $user;
    public Setting $setting;

    public function __construct(public int $chat_id)
    {
        $this->user = User::where('chat_id', $this->chat_id)->first();
        $this->setting = Setting::find(1);

        app()->setLocale($this->user->lang);
        session()->put('locale', $this->user->lang);
    }

    public function process(string $callback, string $callback_id, $message_id): void
    {
        if ($callback === 'confirm') {

            $this->user->update([
                'is_confirm' => true
            ]);

            (new TelegramSendingService())->answerCallback($this->user->chat_id, $callback_id, '✅');
            (new TelegramSendingService())->removeMessage($this->user->chat_id, $message_id);

            $videoPath = isset($this->setting->markup['video'][$this->user->lang]) ?
                $this->setting->markup['video'][$this->user->lang] : null;

            if ($videoPath) {
                (new TelegramSendingService())->sendVideo($this->user->chat_id, asset($videoPath));
            }

            (new TelegramMessageService($this->user->chat_id))->main();
        }

        if ($callback === 'change_lang') {
            (new TelegramAuthService())->language($this->user->chat_id);
            (new TelegramSendingService())->answerCallback($this->user->chat_id, $callback_id, '✅');
            (new TelegramSendingService())->removeMessage($this->user->chat_id, $message_id);
        }

        if (str_starts_with($callback, 'inquiry_')) {
            (new TelegramSendingService())->answerCallback($this->user->chat_id, $callback_id, '✅');

            preg_match('/(\d+)/', $callback, $matches);
            $inquiryId = $matches[0];
            $inquiry = Inquiry::find($inquiryId);
            $message = $inquiry->markup;

            if ($inquiry) {
                if (str_contains($callback, 'inquiry_accept')) {
                    $inquiry->status = Inquiry::STATUS_ACCEPTED;
                    $message .= PHP_EOL . PHP_EOL . 'Принял ' . '(@' . $this->user?->username . ')';
                } elseif (str_contains($callback, 'inquiry_cancel')) {
                    $inquiry->status = Inquiry::STATUS_CANCELLED;
                    $message .= PHP_EOL . PHP_EOL . 'Отменил ' . '(@' . $this->user?->username . ')';
                } elseif (str_contains($callback, 'inquiry_completed')) {
                    $inquiry->status = Inquiry::STATUS_COMPLETED;
                    $message .= PHP_EOL . PHP_EOL . 'Выполнен ' . '(@' . $this->user?->username . ')';
                }

                $inquiry->markup = $message;

                // Сохранение статуса заявки
                $inquiry->save();

                // Отправляем обновленное сообщение с новой клавиатурой
                TelegramCommentsService::sendUpdatedMessage($message, $inquiry, $message_id);
            }
        }
    }
}
