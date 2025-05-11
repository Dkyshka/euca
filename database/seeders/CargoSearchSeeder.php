<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoSearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page = Page::create([
            'name_ru' => 'Поиск грузов',
            'name_uz' => 'Поиск грузов',
            'name_en' => 'Поиск грузов',
            'slug' => 'cargo-search',
            'slug_name' => 'cargo-search',
            'header' => true,
            'footer' => true,
            'meta_title_ru' => 'Поиск грузов',
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
            'type' => 'cargo-search',
            'section_name' => 'Поиск грузов'
        ]);

        $section->update(['sort_order' => $section->id]);
    }
}
