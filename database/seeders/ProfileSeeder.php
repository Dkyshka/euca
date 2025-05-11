<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        $page = Page::create([
            'name_ru' => 'Сообщения',
            'name_uz' => 'Сообщения',
            'name_en' => 'Сообщения',
            'slug' => 'messages',
            'slug_name' => 'messages',
            'header' => false,
            'meta_title_ru' => 'Сообщения',
        ]);

        $page->update(['sort_order' => $page->id]);

        $page = Page::create([
            'name_ru' => 'Тарифы',
            'name_uz' => 'Тарифы',
            'name_en' => 'Тарифы',
            'slug' => 'tariffs',
            'slug_name' => 'tariffs',
            'header' => false,
            'meta_title_ru' => 'Тарифы',
        ]);

        $page->update(['sort_order' => $page->id]);

        $page = Page::create([
            'name_ru' => 'Настройки профиля',
            'name_uz' => 'Настройки профиля',
            'name_en' => 'Настройки профиля',
            'slug' => 'settings',
            'slug_name' => 'settings',
            'header' => false,
            'meta_title_ru' => 'Настройки профиля',
        ]);

        $page->update(['sort_order' => $page->id]);

        $page = Page::create([
            'name_ru' => 'Настройки компании',
            'name_uz' => 'Настройки компании',
            'name_en' => 'Настройки компании',
            'slug' => 'companies',
            'slug_name' => 'companies',
            'header' => false,
            'meta_title_ru' => 'Настройки компании',
        ]);

        $page->update(['sort_order' => $page->id]);

        $page = Page::create([
            'name_ru' => 'Управление подпиской',
            'name_uz' => 'Управление подпиской',
            'name_en' => 'Управление подпиской',
            'slug' => 'subscribes',
            'slug_name' => 'subscribes',
            'header' => false,
            'meta_title_ru' => 'Управление подпиской',
        ]);

        $page->update(['sort_order' => $page->id]);

        $page = Page::create([
            'name_ru' => 'Ваши грузы',
            'name_uz' => 'Ваши грузы',
            'name_en' => 'Ваши грузы',
            'slug' => 'cargos',
            'slug_name' => 'cargos',
            'header' => false,
            'meta_title_ru' => 'Ваши грузы',
        ]);

        $page->update(['sort_order' => $page->id]);

    }
}