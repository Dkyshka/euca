<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Picture;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function destroy(Picture $picture): JsonResponse
    {
        if ($picture->delete()) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
