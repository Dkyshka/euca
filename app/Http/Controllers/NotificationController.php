<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function allRead($lang): JsonResponse
    {
        $user = Auth::user();

        NotificationService::markAllAsRead($user);

        return response()->json([
            'status' => true,
        ]);
    }
}
