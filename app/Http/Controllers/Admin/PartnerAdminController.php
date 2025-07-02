<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewsRequest;
use App\Models\Company;
use App\Models\Review;
use App\Services\LogHistoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartnerAdminController extends Controller
{
    public function index(Request $request): View
    {
        $query = Company::query()->orderByDesc('id');

        if ($request->filled('status_id')) {
            $query->where('status_id', $request->input('status_id'));
        }

        if ($request->filled('is_partner')) {
            $query->where('is_partner', $request->input('is_partner'));
        }

        if ($request->filled('name')) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($request->input('name')) . '%']);
        }

        $partners = $query->paginate(15);

        $statuses = \App\Models\Status::all();

        return view('admin.partners.partners', compact('partners', 'statuses'));
    }

    public function edit(Company $company): View
    {
        return view('admin.partners.partners-edit', compact('company'));
    }

    public function update(Request $request, Company $company): RedirectResponse
    {
        try {
            $request->validate([
                'status_id' => 'required|integer|exists:statuses,id',
                'is_partner' => 'required|integer|in:0,1',
                'name' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'employees_count' => 'required|integer|min:0',
                'website' => 'nullable|string|max:255',
            ]);

            $company->update($request->all());

            LogHistoryService::setLog($request->ip(), 'Компания «'.$company->id.'» отредактирован');

            if ($request->apply) {
                return redirect(route('partner_edit', $company->id))->with('success', 'Компания успешно обновлен');

            }

            return redirect(route('partner_admin'))->with('success', 'Компания успешно обновлена');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Ошибка при обновлении партнера: ' . $e->getMessage()]);

        }
    }
}
