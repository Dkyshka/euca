<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = ['name_ru', 'name_uz', 'name_en'];

    public function name(): Attribute
    {
        $locale = app()->getLocale();

        return Attribute::get(fn() => $this->attributes["name_$locale"] ?? $this->attributes['name_ru']);
    }

    public function companies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_direction');
    }
}
