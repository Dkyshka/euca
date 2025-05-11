<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'sort_order',
        'page_id',
        'section_name',
        'type',
        'status',
        'show_full',
        'markup',
        'data',
        'added_by',
        'modified_by'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'added_by' => 'datetime',
        'modified_by' => 'datetime',
    ];

    /**
     * @var string[]
     */
    protected $with = [
        'pictures',
    ];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($section) {
            $section->pictures()->delete();
        });
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

    /**
     * @return BelongsTo
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * @return Model|null
     */
    public function picture(): Model|null
    {
        return $this->morphMany(Picture::class, 'imageable')->first();
    }

    /**
     * @return MorphMany
     */
    public function pictures(): MorphMany
    {
        return $this->morphMany(Picture::class, 'imageable');
    }
}
