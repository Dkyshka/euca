<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['Узбекистан', 'O‘zbekiston', 'Uzbekistan'],
            ['Казахстан', 'Qozog‘iston', 'Kazakhstan'],
            ['Таджикистан', 'Tojikiston', 'Tajikistan'],
            ['Китай', 'Xitoy', 'China'],
            ['Литва', 'Litva', 'Lithuania'],
            ['Латвия', 'Latviya', 'Latvia'],
            ['Турция', 'Turkiya', 'Turkey'],
            ['Пакистан', 'Pokiston', 'Pakistan'],
            ['Афганистан', 'Afgʻoniston', 'Afghanistan'],
            ['Чехия', 'Chexiya', 'Czech Republic'],
            ['Иран', 'Eron', 'Iran'],
            ['Румыния', 'Ruminiya', 'Romania'],
        ];

        foreach ($countries as [$ru, $uz, $en]) {
            Country::create([
                'name_ru' => $ru,
                'name_uz' => $uz,
                'name_en' => $en,
                'code' => 'ru'
            ]);
        }
    }
}
