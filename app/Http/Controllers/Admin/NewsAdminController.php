<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Models\Page;
use App\Services\LogHistoryService;
use App\Traits\Filesaver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsAdminController extends Controller
{
    use Filesaver;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $news = News::orderByDesc('id')->paginate(15);

        return view('admin.news.news', compact('news'));
    }

    public function create(): View
    {
        $pages = Page::typeNews()->get();

        return view('admin.news.news-create', compact('pages'));
    }

    public function store(NewsRequest $newsRequest): RedirectResponse
    {
        try {
            $filepath = $newsRequest->filepath ? explode(',', $newsRequest->filepath) : null;

            if ($filepath) {
                foreach ($filepath as $key => $file):
                    $filepath[$key] = str_replace([url('/')], [''], $file);
                endforeach;
            }

            $news = News::create($newsRequest->validated());
            $news->update(['sort_order' => $news->id]);

            if ($filepath) {
                $this->storeFiles($filepath, $news);
            }

            LogHistoryService::setLog($newsRequest->ip(), 'Новость «'.$newsRequest->name_ru.'» создана');

            if ($newsRequest->apply) {
                return redirect(route('news_edit', $news->id));
            }

            return redirect(route('news_admin'))->with('success', 'Новость успешно создана');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Ошибка при добавлении: ' . $e->getMessage()]);
        }
    }

    public function edit(News $news): View
    {
        $pages = Page::typeNews()->get();

        return view('admin.news.news-edit', compact('news', 'pages'));
    }

    public function update(NewsRequest $newsRequest, News $news): RedirectResponse
    {
        try {
            $filepath = $newsRequest->filepath ? explode(',', $newsRequest->filepath) : null;

            if ($filepath) {
                foreach ($filepath as $key => $file):
                    $filepath[$key] = str_replace([url('/')], [''], $file);
                endforeach;
            }

            if ($filepath) {
                $this->storeFiles($filepath, $news);
            }

            $news->update($newsRequest->validated());

            LogHistoryService::setLog($newsRequest->ip(), 'Новость «'.$newsRequest->name_ru.'» отредактирована');

            if ($newsRequest->apply) {
                return redirect(route('news_edit', $news->id));
            }

            return redirect(route('news_admin'))->with('success', 'Новость успешно обновлена');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Ошибка при обновлении новости: ' . $e->getMessage()]);

        }
    }

    public function destroy(News $news): RedirectResponse
    {
        try {
            $news->delete();
            LogHistoryService::setLog(request()->ip(), 'Новость «'.$news->name_ru.'» удалена');

            return redirect(route('news_admin'))->with('success', 'Новость успешно удалена');
        } catch (\Exception $e) {
            return redirect(route('news_admin'))->with('error', 'Ошибка при удалении новости: ' . $e->getMessage());
        }
    }

    public function changeStatus(Request $request, News $news): JsonResponse
    {
        $choice = optional($request)->choice;

        if ($choice == 1 || $choice == 0) {
            $news->update(['status' => !$choice ?: 0]);

            return response()->json(['choice' => $choice ? 0 : 1]);
        }

        return response()->json(['error' => 'Invalid choice'], 400);
    }
}
