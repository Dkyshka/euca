<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Transport;
use App\Services\LogHistoryService;
use Illuminate\Http\Request;

class TransportAdminController extends Controller
{
    public function edit(Transport $transport)
    {
        return view('admin.statistics.transport.transport-edit', compact('transport'));
    }

    public function update(Request $request, Transport $transport)
    {
        $request->validate([
            'country' => 'required',
            'final_country' => 'required',
            'body_type' => 'required',
        ]);

        $transport->update($request->all());

        LogHistoryService::setLog($request->ip(), 'Транспорт «'.$transport->id.'» отредактирован');

        if ($request->apply) {
            return redirect(route('transport_admin_edit', $transport->id))->with('success', 'Транспорт успешно обновлен');
        }

        return redirect(route('statistic_transport'))->with('success', 'Транспорт успешно обновлен');
    }

    public function delete(Transport $transport)
    {
        $transport->delete();

        LogHistoryService::setLog(request()->ip(), 'Транспорт «'.$transport->id.'» удален');

        return redirect(route('statistic_transport'))->with('success', 'Транспорт успешно удален');
    }
}
