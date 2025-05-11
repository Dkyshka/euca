<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page = Page::create([
            'name_ru' => 'Каталог участников',
            'name_uz' => 'Каталог участников',
            'name_en' => 'Каталог участников',
            'slug' => 'catalog',
            'slug_name' => 'catalog',
            'header' => true,
            'footer' => true,
            'meta_title_ru' => 'Каталог участников',
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
            'type' => 'catalog',
            'section_name' => 'Каталог участников'
        ]);

        $section->update(['sort_order' => $section->id]);
    }
}
