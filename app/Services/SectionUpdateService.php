<?php

namespace App\Services;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionUpdateService
{
    // Реализовать динамику
    public static function updateSort(Request $request)
    {
        $ids = array_values($request->sectionIds);
        $cats = $request->sectionIds;
        sort($cats);

        foreach ($cats as $i => $sectionId) {
            Section::whereId($ids[$i])->update(['sort_order' => $sectionId]);
        }

    }
}