<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingAdminController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('admin.settings.index', compact('setting'));
    }

    public function update(Setting $setting, Request $request)
    {
        $request->validate([
            'markup.public_offer.ru' => 'nullable|file|mimes:pdf|max:10240',
            'markup.public_offer.uz' => 'nullable|file|mimes:pdf|max:10240',
            'markup.public_offer.en' => 'nullable|file|mimes:pdf|max:10240',
            'markup.video.ru' => 'nullable|file|mimes:mp4,webm|max:102400',
            'markup.video.uz' => 'nullable|file|mimes:mp4,webm|max:102400',
            'markup.video.en' => 'nullable|file|mimes:mp4,webm|max:102400',
        ]);

        $markup = $setting->markup ?? [];
        $newMarkup = $request->input('markup', []);

        foreach (['ru', 'uz', 'en'] as $lang) {
            if ($request->hasFile("markup.public_offer.$lang")) {
                if (isset($markup['public_offer'][$lang])) {
                    Storage::delete(str_replace('storage/', 'public/', $markup['public_offer'][$lang]));
                }

                $filePath = $request->file("markup.public_offer.$lang")->store('public/public_offers');
                $newMarkup['public_offer'][$lang] = str_replace('public/', 'storage/', $filePath);
            } elseif (isset($markup['public_offer'][$lang])) {
                $newMarkup['public_offer'][$lang] = $markup['public_offer'][$lang];
            }

            if ($request->hasFile("markup.video.$lang")) {
                if (isset($markup['video'][$lang])) {
                    Storage::delete(str_replace('storage/', 'public/', $markup['video'][$lang]));
                }

                $filePath = $request->file("markup.video.$lang")->store('public/videos');
                $newMarkup['video'][$lang] = str_replace('public/', 'storage/', $filePath);
            } elseif (isset($markup['video'][$lang])) {
                $newMarkup['video'][$lang] = $markup['video'][$lang];
            }
        }

        $setting->update(['markup' => $newMarkup]);

        return redirect(route('setting_index'))
            ->with('success', 'Настройки успешно обновлены');
    }
}