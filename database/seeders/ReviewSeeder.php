<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $review = Review::create([
            'name_ru' => 'Jon Jonson',
            'name_uz' => 'Jon Jonson',
            'name_en' => 'Jon Jonson',
            'markup' => [
                'ru' => [
                    'one' => 'Lorem ipsum dolor sit amet consectetur. Tortor at elit tristique quam. Tincidunt phasellus amet ametvelit amet maecenas viverra ornare pulvinar. Amet nunc quis venenatis in consequat. In rhoncus proin posuere facilisi enim dignissim purus volutpat nisl.',
                    'two' => 'Узбекистан, Ташкент'
                ],
                'uz' => [
                    'one' => 'Lorem ipsum dolor sit amet consectetur. Tortor at elit tristique quam. Tincidunt phasellus amet ametvelit amet maecenas viverra ornare pulvinar. Amet nunc quis venenatis in consequat. In rhoncus proin posuere facilisi enim dignissim purus volutpat nisl.',
                    'two' => 'Узбекистан, Ташкент'
                ],
                'en' => [
                    'one' => 'Lorem ipsum dolor sit amet consectetur. Tortor at elit tristique quam. Tincidunt phasellus amet ametvelit amet maecenas viverra ornare pulvinar. Amet nunc quis venenatis in consequat. In rhoncus proin posuere facilisi enim dignissim purus volutpat nisl.',
                    'two' => 'Узбекистан, Ташкент'
                ]
            ]
        ]);

        $review->pictures()->create([
            'orig' => '/storage/photos/shares/customs.jpg',
            'avif' => '/storage/photos/shares/customs.jpg'
        ]);
    }
}
