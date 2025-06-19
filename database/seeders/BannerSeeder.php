<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banner = Banner::create([
            'type_banner' => 'header',
            'status' => true,
            'link' => ''
        ]);

        $banner->pictures()->create([
            'orig' => '/assets/images/banner_right.jpg',
            'avif' => '/assets/images/banner_right.jpg'
        ]);

        $banner = Banner::create([
            'type_banner' => 'section',
            'status' => true,
            'link' => ''
        ]);

        $banner->pictures()->create([
            'orig' => '/assets/images/0517.gif',
            'avif' => '/assets/images/0517.gif'
        ]);
    }
}