<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::create([
            'name_ru' => 'коробки',
            'name_uz' => 'коробки',
            'name_en' => 'коробки',
        ]);

        Package::create([
            'name_ru' => 'палеты',
            'name_uz' => 'палеты',
            'name_en' => 'палеты',
        ]);

        Package::create([
            'name_ru' => 'пачки',
            'name_uz' => 'пачки',
            'name_en' => 'пачки',
        ]);

        Package::create([
            'name_ru' => 'мешки',
            'name_uz' => 'мешки',
            'name_en' => 'мешки',
        ]);
    }
}
