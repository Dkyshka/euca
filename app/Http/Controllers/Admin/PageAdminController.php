<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Services\LogHistoryService;
use App\Services\PageDataService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageAdminController extends Controller
{
    /**
     * @return View
     */
    public function create(): View
    {
        $pages = Page::all();
        return view('admin.pages.page-create', compact('pages'));
    }

    /**
     * @param PageRequest $pageRequest
     * @return RedirectResponse
     */
    public function store(PageRequest $pageRequest): RedirectResponse
    {
        if($page = Page::create(array_merge($pageRequest->validated(), PageDataService::extractPageData($pageRequest)))) {
            $page->update(['sort_order' => $page->id]);

            LogHistoryService::setLog($pageRequest->ip(), 'Раздел «'.$pageRequest->name_ru.'» создан');

            if ($pageRequest->apply) {
                return redirect(route('page_edit', $page->id));
            }

            return redirect(route('admin_index'));
        }

        return back()->withInput()->withErrors(['error' => 'Что-то пошло не так']);
    }

    /**
     * @param Page $page
     * @return View
     */
    public function edit(Page $page): View
    {
        $pages = Page::all();
        return view('admin.pages.page', compact('page', 'pages'));
    }

    /**
     * @param Page $page
     * @param PageRequest $pageRequest
     * @return RedirectResponse
     */
    public function update(Page $page, PageRequest $pageRequest): RedirectResponse
    {
        $page->update(array_merge($pageRequest->validated(), PageDataService::extractPageData($pageRequest)));

        LogHistoryService::setLog($pageRequest->ip(), 'Раздел «'.$pageRequest->name_ru.'» отредактирован');

        if ($pageRequest->apply) {
            return redirect(route('page_edit', $page->id));
        }

        return redirect(route('admin_index'));
    }

    /**
     * @param Page $page
     * @return RedirectResponse
     */
    public function destroy(Page $page): RedirectResponse
    {
        if($page->id == 1) {
            return redirect(route('admin_index'));
        }

        LogHistoryService::setLog(request()->ip(), 'Раздел «'.$page->name_ru.'» удален');
        $page->delete();

        return redirect(route('admin_index'));
    }

}
