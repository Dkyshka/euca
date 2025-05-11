<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logs;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        $logs = Logs::orderByDesc('id')->paginate(20);

        return view('admin.logs.log', compact('logs'));
    }
}
