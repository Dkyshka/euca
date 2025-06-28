<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    public function send(User $user, string $title, ?string $body = null): Notification
    {
        return Notification::create([
            'user_id' => $user->id,
            'title'   => $title,
            'body'    => $body,
        ]);
    }

    public function markAsRead(Notification $notification): void
    {
        $notification->update(['is_read' => true]);
    }

    public function markAllAsRead(User $user): void
    {
        Notification::where('user_id', $user->id)->where('is_read', false)->update(['is_read' => true]);
    }
}