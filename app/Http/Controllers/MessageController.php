<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage($locale, Request $request, Chat $chat): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'files.*' => 'file|max:10240',
        ]);

        $message = $chat->messages()->create([
            'user_id' => auth()->id(),
            'message' => $request->input('message'),
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('chat_files', 'public');

                $message->attachments()->create([
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        return response()->json([
            'html' => view('components.chat.message', compact('message'))->render()
        ]);
    }

    public function getOrCreatePrivateChat(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id|not_in:' . Auth::id(),
            'message' => 'required|string|max:1000',
        ]);

        $recipient = User::findOrFail($request->input('recipient_id'));
        $sender = Auth::user();

        // Найти существующий чат между двумя пользователями
        $chat = Chat::whereHas('users', fn($q) => $q->where('user_id', $recipient->id))
            ->whereHas('users', fn($q) => $q->where('user_id', $sender->id))
            ->whereDoesntHave('users', fn($q) => $q->whereNotIn('user_id', [$recipient->id, $sender->id]))
            ->first();

        // Если чата нет — создаём
        if (!$chat) {
            $chat = Chat::create([
                'title' => $recipient->login . '-' . $sender->login,
            ]);
            $chat->users()->syncWithoutDetaching([$recipient->id, $sender->id]);
        }

        // Создаём сообщение
        $chat->messages()->create([
            'user_id' => $sender->id,
            'message' => $request->input('message'),
        ]);

        return response()->json([
            'status' => true,
        ]);
    }
}
