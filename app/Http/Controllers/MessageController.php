<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\JsonResponse;
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
            'sender_id' => auth()->id(),
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

    public function getOrCreatePrivateChat(Request $request): JsonResponse
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id|not_in:' . auth()->id(),
            'message' => 'required|string|max:1000',
        ]);

        $recipient = User::findOrFail($request->input('recipient_id'));
        $sender = auth()->user();

        // Найти существующий чат (в любом направлении)
        $chat = Chat::where(function ($q) use ($sender, $recipient) {
            $q->where('sender_id', $sender->id)
                ->where('recipient_id', $recipient->id);
        })->orWhere(function ($q) use ($sender, $recipient) {
            $q->where('sender_id', $recipient->id)
                ->where('recipient_id', $sender->id);
        })->first();

        // Если чата нет — создать
        if (! $chat) {
            $chat = Chat::create([
                'sender_id' => $sender->id,
                'recipient_id' => $recipient->id,
                'title' => $recipient->name . ' — ' . $sender->name,
            ]);
        }

        // Создать сообщение
        $message = $chat->messages()->create([
            'sender_id' => $sender->id,
            'message' => $request->input('message'),
            'is_read' => false,
        ]);

        return response()->json([
            'status' => true,
            'message_id' => $message->id,
        ]);
    }
}
