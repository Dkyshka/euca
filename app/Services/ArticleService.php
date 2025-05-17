<?php

namespace App\Services;

use App\Models\Cargo;
use App\Models\CargoLoading;
use App\Models\Company;
use App\Models\News;
use App\Models\Page;
use Illuminate\Database\Eloquent\Model;

class ArticleService
{
    public static Model $article;

    public static function news(Page $page, $article): array
    {
        self::$article = News::wherePageId($page->id)->whereSlug($article)->firstOrFail();

        return [
            'template' => 'news',
            'model' => self::$article
        ];
    }

    public static function company(Page $page, $article): array
    {
        self::$article = Company::where('is_active', true)
            ->where('id', $article)
            ->firstOrFail();

        return [
            'template' => 'company-inner',
            'model' => self::$article
        ];
    }

    public static function cargo(Page $page, $article): array
    {
        self::$article = CargoLoading::where('status', 1)
            ->where('id', $article)
            ->firstOrFail();

        return [
            'template' => 'cargo-inner',
            'model' => self::$article
        ];
    }
}