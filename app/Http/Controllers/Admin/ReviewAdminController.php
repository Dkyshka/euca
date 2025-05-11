<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\ReviewsRequest;
use App\Models\News;
use App\Models\Page;
use App\Models\Review;
use App\Services\LogHistoryService;
use App\Traits\Filesaver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewAdminController extends Controller
{
    use Filesaver;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $reviews = Review::orderByDesc('id')->paginate(15);

        return view('admin.reviews.reviews', compact('reviews'));
    }

    public function create(): View
    {
        return view('admin.reviews.review-create');
    }

    public function store(ReviewsRequest $reviewsRequest): RedirectResponse
    {
        try {
            $filepath = $reviewsRequest->filepath ? explode(',', $reviewsRequest->filepath) : null;

            if ($filepath) {
                foreach ($filepath as $key => $file):
                    $filepath[$key] = str_replace([url('/')], [''], $file);
                endforeach;
            }

            $review = Review::create($reviewsRequest->validated());

            if ($filepath) {
                $this->storeFiles($filepath, $review);
            }

            LogHistoryService::setLog($reviewsRequest->ip(), 'Отзыв «'.$reviewsRequest->name_ru.'» создан');

            if ($reviewsRequest->apply) {
                return redirect(route('review_edit', $review->id));
            }

            return redirect(route('review_admin'))->with('success', 'Отзыв успешно создан');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Ошибка при добавлении: ' . $e->getMessage()]);
        }
    }

    public function edit(Review $review): View
    {
        return view('admin.reviews.review-edit', compact('review'));
    }

    public function update(ReviewsRequest $reviewsRequest, Review $review): RedirectResponse
    {
        try {
            $filepath = $reviewsRequest->filepath ? explode(',', $reviewsRequest->filepath) : null;

            if ($filepath) {
                foreach ($filepath as $key => $file):
                    $filepath[$key] = str_replace([url('/')], [''], $file);
                endforeach;
            }

            if ($filepath) {
                $this->storeFiles($filepath, $review);
            }

            $review->update($reviewsRequest->validated());

            LogHistoryService::setLog($reviewsRequest->ip(), 'Отзыв «'.$reviewsRequest->name_ru.'» отредактирован');

            if ($reviewsRequest->apply) {
                return redirect(route('review_edit', $review->id));
            }

            return redirect(route('review_admin'))->with('success', 'Отзыв успешно обновлен');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Ошибка при обновлении новости: ' . $e->getMessage()]);

        }
    }

    public function destroy(Review $review): RedirectResponse
    {
        try {
            $review->delete();
            LogHistoryService::setLog(request()->ip(), 'Отзыв «'.$review->name_ru.'» удален');

            return redirect(route('review_admin'))->with('success', 'Отзыв успешно удален');
        } catch (\Exception $e) {
            return redirect(route('review_admin'))->with('error', 'Ошибка при удалении отзыва: ' . $e->getMessage());
        }
    }

    public function changeStatus(Request $request, Review $review): JsonResponse
    {
        $choice = optional($request)->choice;

        if ($choice == 1 || $choice == 0) {
            $review->update(['status' => !$choice ?: 0]);

            return response()->json(['choice' => $choice ? 0 : 1]);
        }

        return response()->json(['error' => 'Invalid choice'], 400);
    }
}
