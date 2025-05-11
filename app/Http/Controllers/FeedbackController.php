<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Services\TelegramCommentsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class FeedbackController extends Controller
{
    public function sendTelegram(Request $request)
    {
        $request->validate([
            'full_name' => ['required'],
            'phone' => ['required'],
            'message' => ['required', 'max:500', 'min:3'],
        ], [
            'full_name.required' => __('Введите ФИО'),
            'phone.required' => __('Введите телефон'),
            'message.required' => __('Введите сообщение'),
            'message.max' => __('Максимум  500 символов'),
            'message.min' => __('Минимум  3 символа')
        ]);

//        $data = [
//            'name' => $request->name,
//            'city' => $request->city,
//            'phone' => $request->phone,
//            'message' => $request->message,
//            'category' => $request->category == 1 ? 'Для клиентов' : ($request->category == 2 ? 'Для партнеров' : 'Для клиентов'),
//        ];


//        Mail::send('emails.contact', compact('data'), function ($message) use ($data) {
//            $message->to('dkyshka25@gmail.com', 'Aqua-box.uz')
//                ->subject('Новое обращение');
//        });

        $inquiry = Inquiry::create([
            'full_name' => $request?->full_name,
            'phone' => $request?->phone,
            'message' => $request?->message,
            'status' => Inquiry::STATUS_PENDING,
        ]);

        $user = auth()->user();

        $message = '
                Заявка в Телеграм-боте № ' . $inquiry->id .  PHP_EOL . PHP_EOL .
                'ФИО: ' . $request?->full_name . PHP_EOL .
                'Инфо: ' . $request?->message . PHP_EOL .
                'Контакт: ' . '`'.$request?->phone.'`' . PHP_EOL .
                "$user?->name " . '(@' . $user?->username . ')';

        TelegramCommentsService::sendMessageWithInlineKeyboard($message, $inquiry);

        $inquiry->update(['markup' => $message]);

        return redirect()->back()->with('success', __('lang.Ваше сообщение успешно отправлено'));
    }
}
