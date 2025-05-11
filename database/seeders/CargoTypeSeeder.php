<?php

namespace Database\Seeders;

use App\Models\CargoType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CargoType::create([
            'name_ru' => 'Автомобили',
            'name_uz' => 'Автомобили',
            'name_en' => 'Автомобили',
        ]);

        CargoType::create([
            'name_ru' => 'Овощи',
            'name_uz' => 'Овощи',
            'name_en' => 'Овощи',
        ]);

        CargoType::create([
            'name_ru' => 'Мебель',
            'name_uz' => 'Мебель',
            'name_en' => 'Мебель',
        ]);

        CargoType::create([
            'name_ru' => 'Бытовая техника',
            'name_uz' => 'Бытовая техника',
            'name_en' => 'Бытовая техника',
        ]);

        CargoType::create([
            'name_ru' => 'Стройматериалы',
            'name_uz' => 'Стройматериалы',
            'name_en' => 'Стройматериалы',
        ]);
    }
}
