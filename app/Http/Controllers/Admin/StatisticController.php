<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CargoLoading;
use App\Models\Driver;
use App\Models\Transport;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function cargoList()
    {
        $cargoLoadings = CargoLoading::orderBy('id', 'desc')->paginate(15);

        return view('admin.statistics.cargo', compact('cargoLoadings'));
    }

    public function transportList()
    {
        $transports = Transport::orderBy('id', 'desc')->paginate(15);

        return view('admin.statistics.transport', compact('transports'));
    }

    public function drivers()
    {
        $drivers = Driver::orderBy('id', 'desc')->paginate(15);

        return view('admin.statistics.drivers', compact('drivers'));
    }
}
