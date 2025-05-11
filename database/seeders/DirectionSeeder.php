<?php

namespace Database\Seeders;

use App\Models\Direction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Direction::insert([
            [
                'name_ru' => 'FCL (Полная загрузка контейнера)',
                'name_uz' => 'FCL (Toʻliq konteyner yuklash)',
                'name_en' => 'FCL (Full Container Load)'
            ],
            [
                'name_ru' => 'LCL (Меньше чем полная загрузка контейнера)',
                'name_uz' => 'LCL (Toʻliq konteyner yuklashdan kam)',
                'name_en' => 'LCL (Less than Container Load)'
            ],
            [
                'name_ru' => 'Воздушные перевозки',
                'name_uz' => 'Havo yuk tashish',
                'name_en' => 'Air Freight'
            ],
            [
                'name_ru' => 'Железнодорожные перевозки',
                'name_uz' => 'Temiryoʻl yuk tashish',
                'name_en' => 'Rail Freight'
            ],
            [
                'name_ru' => 'Автоперевозки',
                'name_uz' => 'Avtomobil yuk tashish',
                'name_en' => 'Road Freight'
            ],
            [
                'name_ru' => 'Морские перевозки',
                'name_uz' => 'Dengiz yuk tashish',
                'name_en' => 'Sea Freight'
            ],
            [
                'name_ru' => 'Контейнерные перевозки',
                'name_uz' => 'Konteyner yuk tashish',
                'name_en' => 'Container Shipping'
            ],
            [
                'name_ru' => 'Мультимодальные перевозки',
                'name_uz' => 'Multimodal yuk tashish',
                'name_en' => 'Intermodal Transport'
            ],
            [
                'name_ru' => 'Курьерские услуги',
                'name_uz' => 'Kuryerlik xizmatlar',
                'name_en' => 'Courier Services'
            ],
            [
                'name_ru' => 'Плоские платформы',
                'name_uz' => 'Tekis platformalar',
                'name_en' => 'Flatbed Freight'
            ],
            [
                'name_ru' => 'Наливные перевозки',
                'name_uz' => 'Yog‘liq yuk tashish',
                'name_en' => 'Bulk Freight'
            ],
            [
                'name_ru' => 'Логистика с контролем температуры',
                'name_uz' => 'Sovutish bilan yuk tashish',
                'name_en' => 'Cold Chain Logistics'
            ],
            [
                'name_ru' => 'Дропшиппинг',
                'name_uz' => 'Dropshipping',
                'name_en' => 'Drop Shipping'
            ],
            [
                'name_ru' => 'Обратная логистика',
                'name_uz' => 'Teskari logistika',
                'name_en' => 'Reverse Logistics'
            ],
            [
                'name_ru' => 'Проектные грузы',
                'name_uz' => 'Loyiha yuklari',
                'name_en' => 'Project Cargo'
            ],
            [
                'name_ru' => 'Экспресс-доставка',
                'name_uz' => 'Ekspress yuk tashish',
                'name_en' => 'Express'
            ],
            [
                'name_ru' => 'Кросс-докинг',
                'name_uz' => 'Cross-docking',
                'name_en' => 'Cross-docking'
            ],
            [
                'name_ru' => 'Ускоренная доставка',
                'name_uz' => 'Tezlashtirilgan yetkazib berish',
                'name_en' => 'Expedited Shipping'
            ],
            [
                'name_ru' => 'Таможенная очистка',
                'name_uz' => 'Bojxona tozalash',
                'name_en' => 'Customs Clearance'
            ],
        ]);
    }
}
