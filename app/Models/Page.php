<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'sort_order',
        'name_ru',
        'name_uz',
        'name_en',
        'slug',
        'slug_name',
        'status',
        'meta_title_ru',
        'meta_title_uz',
        'meta_title_en',
        'description_ru',
        'description_uz',
        'description_en',
        'header',
        'footer',
        'type_content',
        'template_name',
        'added_by',
        'modified_by',
    ];

    protected $with = [
        'sections'
    ];

    protected static function booted(): void
    {
        static::updating( fn () => Cache::forget('footer_menu'));
    }

    public function markup(): Attribute
    {
        return Attribute::get(fn ($value) => json_decode($value));
    }

    public function name(): Attribute
    {
        $locale = app()->getLocale();

        return Attribute::get(fn() => $this->attributes["name_$locale"] ?? $this->attributes['name_ru']);
    }

    public function link(): Attribute
    {
        return Attribute::get(fn () => url(app()->getLocale().'/'.$this->attributes['slug']));
    }

    public function metaTitle(): Attribute
    {
        $locale = app()->getLocale();

        return Attribute::get(fn() => $this->attributes["meta_title_$locale"] ?? $this->attributes['meta_title_ru']);
    }

    public function description(): Attribute
    {
        $locale = app()->getLocale();


        return Attribute::get(fn() => $this->attributes["description_$locale"] ?? $this->attributes['description_ru']);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('sort_order');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function parents(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function articlesNot($article_id, $model): \Illuminate\Database\Eloquent\Collection
    {
        return $this->hasMany($model)->take(4)->whereNot('id', $article_id)->orderByDesc('id')->get();
    }

    public function scopeVisible($query): mixed
    {
        return $query->whereStatus(1);
    }
}
