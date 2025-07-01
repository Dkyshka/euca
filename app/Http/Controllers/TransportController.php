<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransportController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'country' => 'required',
            'final_country' => 'required',
            'body_type' => 'required',
            'driver_id' => 'nullable|exists:drivers,id',
            'capacity' => 'nullable|string|max:255',
            'volume' => 'nullable|string|max:255',
            'length' => 'nullable|string|max:255',
            'width' => 'nullable|string|max:255',
            'height' => 'nullable|string|max:255',

            'payment_type' => 'required|in:no_haggling,payment_request',
            'comment' => 'nullable|string',

            'with_vat_cashless' => [
                'nullable',
                'numeric',
                'required_without_all:without_vat_cashless,cash'
            ],
            'without_vat_cashless' => [
                'nullable',
                'numeric',
                'required_without_all:with_vat_cashless,cash'
            ],
            'cash' => [
                'nullable',
                'numeric',
                'required_without_all:with_vat_cashless,without_vat_cashless'
            ],
            'currency' => 'nullable|string',

            'availability_mode' => 'nullable|in:date,workdays,weekends,daily',
            'ready_date' => 'nullable|date|required_if:availability_mode,date',
        ]);

        Transport::create([
            'user_id' => Auth::id(),
            ...$validated,
            'ready_to_load_at' => $validated['availability_mode'] === 'date'
                ? $validated['ready_to_load_at']
                : null,
        ]);

        return response()->json(['status' => true]);
    }

    public function update(Request $request, $locale, Transport $transport)
    {
        $validated = $request->validate([
            'country' => 'required',
            'final_country' => 'required',
            'body_type' => 'required',
            'driver_id' => 'nullable|exists:drivers,id',
            'capacity' => 'nullable|string|max:255',
            'volume' => 'nullable|string|max:255',
            'length' => 'nullable|string|max:255',
            'width' => 'nullable|string|max:255',
            'height' => 'nullable|string|max:255',

            'payment_type' => 'required|in:no_haggling,payment_request',
            'comment' => 'nullable|string',

            'with_vat_cashless' => [
                'nullable',
                'numeric',
                'required_without_all:without_vat_cashless,cash'
            ],
            'without_vat_cashless' => [
                'nullable',
                'numeric',
                'required_without_all:with_vat_cashless,cash'
            ],
            'cash' => [
                'nullable',
                'numeric',
                'required_without_all:with_vat_cashless,without_vat_cashless'
            ],
            'currency' => 'nullable|string',

            'availability_mode' => 'nullable|in:date,workdays,weekends,daily',
            'ready_date' => 'nullable|date|required_if:availability_mode,date',
        ]);

        $validated['ready_date'] = $request->when_type == 1 ? $validated['ready_date'] : null;
        $validated['availability_mode'] = $request->when_type == 2 ? $validated['availability_mode'] : null;

        $transport->update([
            ...$validated,
        ]);

        return redirect()->route('auto-park');
    }

    public function delete($locale, Transport $transport)
    {
        $transport->delete();

        return redirect()->route('auto-park');
    }
}
