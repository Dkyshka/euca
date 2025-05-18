<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\Direction;
use App\Models\Section;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Request;

class Catalog extends Component
{
    public function __construct(public Section $section)
    {
    }

    public function render(): View|Closure|string
    {
        $query = Company::query()
            ->where('is_active', true);

        if ($country = Request::get('country')) {
            $query->where('country', 'ilike', "%$country%");
        }

        if ($city = Request::get('city')) {
            $query->where('address', 'ilike', "%$city%");
        }

        if ($name = Request::get('name')) {
            $query->where('name', 'ilike', "%$name%");
        }

        if ($companyId = Request::get('companyId')) {
            $query->where('id', $companyId);
        }

        if (request()->filled('minValue') && request()->filled('maxValue')) {
            $min = (int) request('minValue');
            $max = (int) request('maxValue');

            // created_at от X до Y дней назад
            $query->whereBetween('created_at', [
                now()->subDays($max),
                now()->subDays($min),
            ]);
        }

        if ($statusIds = Request::get('statuses')) {
            $query->whereIn('status_id', $statusIds);
        }

        if ($directionIds = Request::get('directions')) {
            $query->whereHas('directions', function ($q) use ($directionIds) {
                $q->whereIn('directions.id', $directionIds);
            });
        }

        $companies = $query
            ->orderBy('id', 'asc')
            ->paginate(25)
            ->appends(Request::except('page'));

        $newCompanies = Company::where('is_active', true)
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->get();

        $directions = Direction::limit(10)->get();

        return view('components.catalog',
            compact('companies', 'directions', 'newCompanies'));
    }
}
