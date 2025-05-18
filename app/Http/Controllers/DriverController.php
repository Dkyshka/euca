<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'phone'       => 'required|string|max:20|min:7',
            'birth_date'  => 'required|date|before:today',
        ]);

        Driver::create([
            'user_id'     => auth()->id(),
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
            'middle_name' => $request->middle_name,
            'phone'       => $request->phone,
            'birth_date'  => $request->birth_date,
        ]);

        return response()->json(['success' => true]);
    }
}
