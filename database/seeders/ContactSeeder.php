<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page = Page::create([
            'name_ru' => 'Контакты',
            'name_uz' => 'Контакты',
            'name_en' => 'Контакты',
            'slug' => 'contacts',
            'slug_name' => 'contacts',
            'header' => true,
            'footer' => true,
            'meta_title_ru' => 'Контакты',
        ]);

        $page->update(['sort_order' => $page->id]);

        // Catalog
        $section = $page->sections()->create([
            'markup' => [
                'ru' => [
                    'one' => '<b>Свяжитесь с нами</b>
                            <p>Мы предоставляем надежные, быстрые и инновационные логистические услуги, которые позволяют компаниям
                                процветать на конкурентном рынке.
                            </p>'
                ],
                'uz' => [
                    'one' => '<b>Свяжитесь с нами</b>
                            <p>Мы предоставляем надежные, быстрые и инновационные логистические услуги, которые позволяют компаниям
                                процветать на конкурентном рынке.
                            </p>'
                ],
                'en' => [
                    'one' => '<b>Свяжитесь с нами</b>
                            <p>Мы предоставляем надежные, быстрые и инновационные логистические услуги, которые позволяют компаниям
                                процветать на конкурентном рынке.
                            </p>'
                ],
            ],
            'type' => 'contacts',
            'section_name' => 'Контакты'
        ]);

        $section->update(['sort_order' => $section->id]);
    }
}
