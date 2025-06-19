<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Services\LogHistoryService;
use Illuminate\Http\Request;

class DriverAdminController extends Controller
{
    public function edit(Driver $driver)
    {
        return view('admin.statistics.drivers.driver-edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
        ]);

        $driver->update($request->all());

        LogHistoryService::setLog($request->ip(), 'Водитель «'.$driver->id.'» отредактирован');

        if ($request->apply) {
            return redirect(route('driver_admin_edit', $driver->id))->with('success', 'Водитель успешно обновлен');
        }

        return redirect(route('statistic_drivers'))->with('success', 'Водитель успешно обновлен');
    }

    public function delete(Driver $driver)
    {
        $driver->delete();

        LogHistoryService::setLog(request()->ip(), 'Водитель «'.$driver->id.'» удален');

        return redirect(route('statistic_drivers'))->with('success', 'Водитель успешно удален');
    }
}
