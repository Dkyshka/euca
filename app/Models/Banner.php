<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'google_ads',
        'status',
        'link',
        'type_banner'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($banner) {
            $banner->pictures()->delete();
        });
    }

    public function name(): Attribute
    {
        $locale = app()->getLocale();

        return Attribute::get(fn() => $this->attributes["name_$locale"] ?? $this->attributes['name_ru']);
    }

    public function picture(): Model|MorphMany|null
    {
        return $this->morphMany(Picture::class, 'imageable')->first();
    }

    public function pictures(): MorphMany
    {
        return $this->morphMany(Picture::class, 'imageable');
    }

    public function scopeVisible($query): mixed
    {
        return $query->whereStatus(1);
    }
}