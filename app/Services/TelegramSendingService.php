<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TelegramSendingService
{
    protected string $token;
    protected string $key_location;

    public function __construct()
    {
        $this->token = env('TELEGRAM_BOT_TOKEN');
    }

    public function sendMessage(int $chat_id, string $message): void
    {
        $data = [
            "chat_id" => $chat_id,
            "text" => $message,
            "parse_mode" => "html"
        ];

        $this->sendRequest('/sendMessage', $data);
    }

    public function replyMessage(int $chat_id, int $message_id, string $message): void
    {
        $data = [
            "chat_id" => $chat_id,
            "text" => $message,
            "parse_mode" => "html",
            "reply_to_message_id" => $message_id
        ];

        $this->sendRequest('/sendMessage', $data);
    }

    public function removeMessage($chat_id, int $messageId)
    {
        $data = [
            "chat_id" => $chat_id,
            "message_id" => $messageId
        ];

        $this->sendRequest('/deleteMessage', $data);
    }

    public function sendInlineKeyboard(int $chat_id, string $message, array $keyboard)
    {
        $data = [
            "chat_id" => $chat_id,
            "text" => $message,
            "parse_mode" => "markdown",
            'protect_content' => true,
            'reply_markup' => json_encode([
                'inline_keyboard' => $keyboard,
            ]),
        ];

        $this->sendRequest('/sendMessage', $data);
    }

    public function sendKeyboard(int $chat_id, string $message, array $keyboard)
    {
        $data = [
            "chat_id" => $chat_id,
            "text" => $message,
            "parse_mode" => "html",

            'reply_markup' => json_encode([
                'keyboard' => $keyboard,
                'one_time_keyboard' => true, // отключить скрытие меню
                'resize_keyboard' => true, // отключить адаптацию кнопок по высоте
            ]),
        ];

        $this->sendRequest('/sendMessage', $data);
    }

    public function sendVideo(int $chat_id, string $video_path, string $caption = '', array $keyboard = []): void
    {
        $data = [
            'chat_id' => $chat_id,
            'caption' => $caption,
            'video' => curl_file_create($video_path),
            'supports_streaming' => true,
            'reply_markup' => json_encode([
                'inline_keyboard' => $keyboard,
            ]),
        ];

        // Инициализация cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.telegram.org/bot' . $this->token . '/sendVideo');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Выполнение запроса и закрытие cURL
        $response = curl_exec($ch);

        // Проверка на ошибки cURL
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            Log::error('Ошибка cURL: ' . $error_msg);
        }

        curl_close($ch);
    }

    public function sendPhoto($chat_id, $caption, $image, $keyboard = [])
    {
        $data = [
            "chat_id" => $chat_id,
            'caption' => $caption,
            'photo' => $image,
//            'protect_content' => true, // Запрещает сохранение и пересылку
//            'has_spoiler' => false, // Спойлер
            'reply_markup' => json_encode([
                'inline_keyboard' => $keyboard,
            ]),

        ];

        $ch = curl_init("https://api.telegram.org/bot" . $this->token . "/sendPhoto");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    public function sendFile($chat_id, $caption, $document, $keyboard = [])
    {
        $data = [
            "chat_id" => $chat_id,
            'caption' => $caption,
            'document' => $document,
            'reply_markup' => json_encode([
                'inline_keyboard' => $keyboard,
            ]),
//            'protect_content' => true, // Запрещает сохранение и пересылку
        ];

        $ch = curl_init("https://api.telegram.org/bot" . $this->token . "/sendDocument");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    public function sendPhone(int $chat_id, string $message, array $keyboard)
    {
        $data = [
            "chat_id" => $chat_id,
            "text" => $message,
            "parse_mode" => "html",

            'reply_markup' => json_encode([
                'keyboard' => $keyboard,
                'one_time_keyboard' => false,
                'resize_keyboard' => true,
            ]),
        ];

        $this->sendRequest('/sendMessage', $data);
    }

    public function getUserAvatar($userId): ?string
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot{$botToken}/getUserProfilePhotos";

        $response = file_get_contents($url . "?user_id={$userId}&limit=1");

        $data = json_decode($response, true);

        if ($data['ok'] && $data['result']['total_count'] > 0) {
            // Получаем файл ID первой фотографии
            $fileId = $data['result']['photos'][0][0]['file_id'];

            // Получаем ссылку на файл через метод getFile
            return $this->getTelegramFileUrl($fileId);
        }

        return null; // Если фото не найдено
    }

    public function getTelegramFileUrl($fileId): ?string
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot{$botToken}/getFile";

        $response = file_get_contents($url . "?file_id={$fileId}");

        $data = json_decode($response, true);

        if ($data['ok']) {
            $filePath = $data['result']['file_path'];
            return "https://api.telegram.org/file/bot{$botToken}/{$filePath}";
        }

        return null;
    }

    public function downloadAndSaveAvatar($avatarUrl, $userId): ?string
    {
        try {
            $avatarContent = file_get_contents($avatarUrl);
            $fileName = 'avatars/user_' . $userId . '_' . uniqid() . '.jpg';
            Storage::disk('public')->put($fileName, $avatarContent);

            return $fileName; // Путь сохранённого файла
        } catch (\Exception $e) {
            return null;
        }
    }

    public function editMessageReplyMarkup($chat_id, string $message_id, $keyboard)
    {
        $data = [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'reply_markup' => json_encode([
                'inline_keyboard' => $keyboard,
            ]),
        ];

        $ch = curl_init("https://api.telegram.org/bot" . $this->token . "/editMessageReplyMarkup");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    public function answerCallback($chat_id, int $callback_id, string $msg)
    {
        $data = [
            "chat_id" => $chat_id,
            "callback_query_id" => $callback_id,
            "text" => $msg
        ];

        $this->sendRequest('/answerCallbackQuery', $data);
    }

    public function sendRequest(string $url, array $data): array
    {
        try {
            $response = Http::post('https://api.telegram.org/bot'.$this->token.$url, $data)->throw();

            return $response->json();
        } catch (\Exception $e) {
            Log::error('Непредвиденная ошибка: ' . $e->getMessage());
            return [];
        }
    }


}
