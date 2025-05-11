<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'markup',
    ];

    protected $casts = [
        'markup' => 'array',
    ];

    protected static function booted(): void
    {
        static::updating( fn () => Cache::forget('site_settings'));
    }

    public function markup(): Attribute
    {
        return Attribute::get(fn($value) => json_decode($value, true));
    }
}
