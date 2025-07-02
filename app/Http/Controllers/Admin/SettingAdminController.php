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
            'public_offer' => 'nullable|file|mimes:pdf|max:10240',
            'terms'        => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $markup = $setting->markup ?? [];

        // Загрузка оферты
        if ($request->hasFile('public_offer')) {
            if (!empty($markup['public_offer'])) {
                Storage::delete(str_replace('storage/', 'public/', $markup['public_offer']));
            }

            $request->file('public_offer')->storeAs('public/public_offers', 'public_offer.pdf');
            $markup['public_offer'] = 'storage/public_offers/public_offer.pdf';
        }

        // Загрузка правил регистрации
        if ($request->hasFile('terms')) {
            if (!empty($markup['terms'])) {
                Storage::delete(str_replace('storage/', 'public/', $markup['terms']));
            }

            $request->file('terms')->storeAs('public/registration_terms', 'registration.pdf');
            $markup['terms'] = 'storage/registration_terms/registration.pdf';
        }

        // Остальные данные, если есть
        $newMarkup = $request->input('markup', []);
        $markup = array_merge($markup, $newMarkup);

        $setting->update(['markup' => $markup]);

        return redirect(route('setting_index'))
            ->with('success', 'Настройки успешно обновлены');
    }
}