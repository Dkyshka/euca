<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CargoLoading;
use App\Services\LogHistoryService;
use Illuminate\Http\Request;

class CargoAdminController extends Controller
{
    public function edit(CargoLoading $cargoLoading)
    {
        return view('admin.statistics.cargo.cargo-edit', compact('cargoLoading'));
    }

    public function update(Request $request, CargoLoading $cargoLoading)
    {
        $request->validate([
            'country' => 'required',
            'final_unload_city' => 'required',
            'status' => 'required|in:1,2,3,4',
        ]);

        $cargoLoading->update($request->all());

        LogHistoryService::setLog($request->ip(), 'Груз «'.$cargoLoading->country.'» отредактирован');

        if ($request->apply) {
            return redirect(route('cargo_admin_edit', $cargoLoading->id))->with('success', 'Груз успешно обновлен');
        }

        return redirect(route('statistic_cargo'))->with('success', 'Груз успешно обновлен');
    }

    public function delete(CargoLoading $cargoLoading)
    {
        $cargoLoading->cargos()->delete();
        $cargoLoading->delete();

        LogHistoryService::setLog(request()->ip(), 'Груз «'.$cargoLoading->country.'» удален');

        return redirect(route('statistic_cargo'))->with('success', 'Груз успешно удален');
    }
}
