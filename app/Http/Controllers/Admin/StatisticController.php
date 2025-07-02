<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CargoLoading;
use App\Models\Driver;
use App\Models\Transport;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function cargoList(Request $request)
    {
        $query = CargoLoading::query()->orderByDesc('id');

        // Фильтр по "откуда"
        if ($request->filled('from')) {
            $query->whereRaw('LOWER(country) LIKE ?', ['%' . strtolower($request->input('from')) . '%']);
        }

        // Фильтр по "куда"
        if ($request->filled('to')) {
            $query->whereRaw('LOWER(final_unload_country) LIKE ?', ['%' . strtolower($request->input('to')) . '%']);
        }
        // Фильтр по статусу
        if ($request->filled('status_id')) {
            $query->where('status', $request->input('status_id'));
        }

        // Фильтр по дате создания
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        $cargoLoadings = $query->paginate(15)->appends($request->all());

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
