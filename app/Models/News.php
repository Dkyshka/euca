<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ru',
        'name_uz',
        'name_en',
        'slug',
        'markup',
        'status',
    ];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(fn($article) => $article->pictures()->delete());
    }

    /**
     * @return Attribute
     */
    public function name(): Attribute
    {
        $locale = app()->getLocale();

        return Attribute::get(fn() => $this->attributes["name_$locale"] ?? $this->attributes['name_ru']);
    }

    /**
     * @return Attribute
     */
    public function markup(): Attribute
    {
        return Attribute::make(fn ($value) => json_decode($value), fn($value) => json_encode($value));
    }

    public function content(): Attribute
    {
        $locale = app()->getLocale() ?? 'ru';
        return Attribute::get(fn ($value) => optional(json_decode($this->attributes['markup'])?->$locale));
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->whereStatus(1);
    }

    public function scopeLastOrder(Builder $query): Builder
    {
        return $query->orderByDesc('id');
    }

    public function picture(): Model|MorphMany|null
    {
        return $this->morphMany(Picture::class, 'imageable')->first();
    }

    public function pictures(): MorphMany
    {
        return $this->morphMany(Picture::class, 'imageable');
    }
}
