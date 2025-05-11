<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportSearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page = Page::create([
            'name_ru' => 'Поиск транспорта',
            'name_uz' => 'Поиск транспорта',
            'name_en' => 'Поиск транспорта',
            'slug' => 'transport-search',
            'slug_name' => 'transport-search',
            'header' => true,
            'footer' => true,
            'meta_title_ru' => 'Поиск транспорта',
        ]);

        $page->update(['sort_order' => $page->id]);

        // Catalog
        $section = $page->sections()->create([
            'markup' => [
                'ru' => [
                ],
                'uz' => [
                ],
                'en' => [
                ],
            ],
            'type' => 'transport-search',
            'section_name' => 'Поиск транспорта'
        ]);

        $section->update(['sort_order' => $section->id]);
    }
}
