<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\Filesaver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BannerAdminController extends Controller
{
    use Filesaver;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'desc')->get();

        return view('admin.banners.banners', compact('banners'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.banner-edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        try {
            $filepath = $request->filepath ? explode(',', $request->filepath) : null;

            if ($filepath) {
                foreach ($filepath as $key => $file):
                    $filepath[$key] = str_replace([url('/')], [''], $file);
                endforeach;
            }

            if ($filepath) {
                $this->storeFiles($filepath, $banner);
            }

            $banner->update([
                'link' => $request->link,
                'status' => $request->status,
            ]);

            if ($request->apply) {
                return redirect(route('banner_edit', $banner->id));
            }

            return redirect(route('banner_admin'))->with('success', 'Баннер успешно обновлен');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Ошибка при обновлении: ' . $e->getMessage()]);
        }
    }

    public function changeStatus(Request $request, Banner $banner): JsonResponse
    {
        $choice = optional($request)->choice;

        if ($choice == 1 || $choice == 0) {
            $banner->update(['status' => !$choice ?: 0]);

            return response()->json(['choice' => $choice ? 0 : 1]);
        }

        return response()->json(['error' => 'Invalid choice'], 400);
    }
}