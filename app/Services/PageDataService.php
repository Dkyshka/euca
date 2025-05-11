<?php

namespace App\Services;

class PageDataService
{
    public static function extractPageData($pageRequest): array
    {
        return [
            'name_uz' => $pageRequest->name_uz ?? $pageRequest->name_ru,
            'name_en' => $pageRequest->name_en ?? $pageRequest->name_ru,
            'status' => $pageRequest->status ?? 1,
            'header' => $pageRequest->header ?? 0,
            'footer' => $pageRequest->footer ?? 0,
            'slug_name' => $pageRequest->slug == '/' ? 'index' : $pageRequest->slug,
            'meta_title_ru' => $pageRequest->meta_title_ru,
            'meta_title_uz' => $pageRequest->meta_title_uz ?? $pageRequest->meta_title_ru,
            'meta_title_en' => $pageRequest->meta_title_en ?? $pageRequest->meta_title_ru,
            'description_ru' => $pageRequest->description_ru,
            'description_uz' => $pageRequest->description_uz ?? $pageRequest->description_ru,
            'description_en' => $pageRequest->description_en ?? $pageRequest->description_ru,
            'type_content' => $pageRequest->type_content,
        ];
    }
}