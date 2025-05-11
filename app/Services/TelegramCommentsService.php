<?php

namespace App\Services;

use App\Models\Inquiry;

class TelegramCommentsService
{
    private static string $token;
    private static string $chat_id;

    public static function sendMessage($message): void
    {
        self::$token = env('TELEGRAM_BOT_COMMENT_TOKEN');
        self::$chat_id = env('TELEGRAM_COMMENTS_CHAT_ID');

        $query = [
            'chat_id' => self::$chat_id,
            'text' => $message,
            'disable_web_page_preview' => true,
            'parse_mode' => 'markdown',
        ];

        self::sendCurl($query, "sendMessage");
    }

    public static function sendMessageWithInlineKeyboard($message, Inquiry $inquiry): void
    {
        self::$token = env('TELEGRAM_BOT_COMMENT_TOKEN');
        self::$chat_id = env('TELEGRAM_COMMENTS_CHAT_ID');

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'Принять 📝', 'callback_data' => 'inquiry_accept_'.$inquiry->id],
                ],
                [
                    ['text' => 'Отменён ❌', 'callback_data' => 'inquiry_cancel_'.$inquiry->id],
                ],
                [
                    ['text' => 'Выполнен ✅', 'callback_data' => 'inquiry_completed_'.$inquiry->id]
                ]
            ]
        ];

        $query = [
            'chat_id' => self::$chat_id,
            'text' => $message,
            'disable_web_page_preview' => true,
            'parse_mode' => 'markdown',
            'reply_markup' => json_encode($keyboard),
        ];

        self::sendCurl($query, "sendMessage");
    }

    public static function sendUpdatedMessage($message, Inquiry $inquiry, $messageId): void
    {
        self::$token = env('TELEGRAM_BOT_COMMENT_TOKEN');
        self::$chat_id = env('TELEGRAM_COMMENTS_CHAT_ID');

        $keyboard = null;

        if ($inquiry->status == Inquiry::STATUS_ACCEPTED) {

            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'Отменён ❌', 'callback_data' => 'inquiry_cancel_' . $inquiry->id],
                    ],
                    [
                        ['text' => 'Выполнен ✅', 'callback_data' => 'inquiry_completed_' . $inquiry->id]
                    ]
                ]
            ];
        }

        $query = [
            'chat_id' => self::$chat_id,
            'message_id' => $messageId,
            'parse_mode' => 'markdown',
            'text' => $message,
        ];

        // Если клавиатура не пустая, добавляем её в запрос
        if ($keyboard !== null) {
            $query['reply_markup'] = json_encode($keyboard);
        }

        self::sendCurl($query, "editMessageText");
    }

    public static function sendCurl(array $data, $endpoint): bool
    {
        $ch = curl_init("https://api.telegram.org/bot". self::$token . '/' . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        if ($result === false) {
            $error = curl_error($ch);
            curl_close($ch);
            return false;
        } else {
            curl_close($ch);
            return true;
        }
    }
}