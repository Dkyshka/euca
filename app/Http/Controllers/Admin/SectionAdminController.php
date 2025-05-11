<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Page;
use App\Models\Section;
use App\Services\LogHistoryService;
use App\Services\SectionUpdateService;
use App\Traits\Filesaver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SectionAdminController extends Controller
{
    use Filesaver;

    public function store(SectionRequest $sectionRequest, Page $page): JsonResponse
    {
        try {
            $section = $page->sections()->create($sectionRequest->validated());
            $section->update(['sort_order' => $section->id]);

            LogHistoryService::setLog($sectionRequest->ip(), 'Блок к разделу «'.$page->name_ru.'» добавлен');

            return response()->json(['status' => '200', 'data' => $section]);

        } catch (\Exception $e) {
            return response()->json(['errors' => 'Ошибка при добавлении: ' . $e->getMessage()], 400);
        }

    }

    public function changeStatus(Request $request, ?Section $section): JsonResponse|Response
    {
        $choice = optional($request)->choice;

        if ($choice == 1 || $choice == 0) {
            $section->update(['status' => !$choice ?: 0]);
            LogHistoryService::setLog($request->ip(), 'Блок «'.$section?->name_ru.'» у раздела «'.$section->page->name_ru.'» изменен статус');

            return response()->json(['choice' => $choice ? 0 : 1]);
        }

        return response()->json(['error' => 'Invalid choice'], 400);
    }

    public function changeSort(Request $request): JsonResponse
    {
        SectionUpdateService::updateSort($request);

        return response()->json(['status' => 200]);
    }

    public function update(Request $request, ?Section $section, ?Page $page): JsonResponse|RedirectResponse
    {
        try {
            $filepath = $request->filepath ? explode(',', $request->filepath) : null;

            if ($filepath) {
                foreach($filepath as $key => $file):
                    $filepath[$key] = str_replace([url('/')], [''], $file);
                endforeach;
            }

            if ($filepath) {
                $this->storeFiles($filepath, $section);
            }

            if (isset($request->markup['images'])) {
                $request->merge([
                    'markup' => array_merge($request->markup, [
                        'images' => array_values($request->markup['images']),
                    ])
                ]);
            }

            $section->update([
                'show_full' => $request->show_full ?? false,
                'markup' => $request->markup,
                'data' => $request->data ?? null
            ]);

            LogHistoryService::setLog($request->ip(), 'Блок у раздела «'.$page->name_ru.'» отредактирован');

            if ($request->section_apply) {
                return redirect(route('page_edit', $page->id.'?'.
                    http_build_query(['section' => $section->id])));
            }

            return redirect(route('page_edit', $page->id.'?show_section=true'));

        } catch (\Exception $e) {
            return response()->json(['errors' => 'Ошибка при добавлении: ' . $e->getMessage()], 400);
        }

    }

    public function destroy(Section $section): JsonResponse
    {
        try {
            $section->delete();
            LogHistoryService::setLog(request()->ip(), 'Блок «'.$section?->name_ru.'» у раздела «'.$section->page->name_ru.'» удален');

            return response()->json(['status' => '200']);

        } catch (\Exception $e) {
            return response()->json(['errors' => 'Ошибка при удалении: ' . $e->getMessage()], 400);
        }
    }
}
