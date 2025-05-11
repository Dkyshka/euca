<?php

namespace App\Services;

use App\Models\Logs;

class LogHistoryService
{
    public static function setLog(string|null $user_ip = null, string|null $message = null)
    {
        Logs::create([
           'user_id' => auth()->user()->id,
           'message' => $message,
           'user_ip' => $user_ip
        ]);
    }
}