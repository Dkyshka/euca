<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function cargoList()
    {
        return view('admin.statistics.cargo');
    }

    public function transportList()
    {
        return view('admin.statistics.transport');
    }

    public function handshakeList()
    {
        return view('admin.statistics.handshake');
    }
}
