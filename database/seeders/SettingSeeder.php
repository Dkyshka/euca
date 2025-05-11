<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'markup' => [
                'address' => [
                    'ru' => "г.Ташкент, Алмазарский район, улица Чукурсой, 41/153",
                    'uz' => "г.Ташкент, Алмазарский район, улица Чукурсой, 41/153",
                    'en' => "г.Ташкент, Алмазарский район, улица Чукурсой, 41/153",
                ],
                'phones' => [
                    '+998 (98) 888-96-05, +998 (98) 888-96-06',
                ],
                'emails' => [
                    'info@euca-alliance.com, info@euca-alliance2.com'
                ],
                'socials' => [
                    'instagram' => 'https://www.instagram.com/',
                    'facebook' => 'https://www.facebook.com/',
                    'youtube' => 'https://www.youtube.com/',
                ],
                'coordinates' => [
                    'lat' => '69.23323003743187',
                    'long' => '41.38296804890838'
                ]
            ]
        ]);
    }
}
