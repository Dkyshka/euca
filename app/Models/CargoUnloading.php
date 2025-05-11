<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CargoUnloading extends Model
{
    use HasFactory;

    protected $fillable = [
        'cargo_id', 'unload_city', 'country', 'unload_country_id', 'unload_address',
        'unload_type', 'unload_weight', 'unload_volume',
        'unload_datetime_from', 'unload_datetime_to', 'is_24h', 'is_final'
    ];

    protected $casts = [
        'unload_datetime_from' => 'datetime',
        'unload_datetime_to' => 'datetime',
        'is_24h' => 'boolean',
        'is_final' => 'boolean',
    ];

    public function cargo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cargo::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'unload_country_id');
    }
}
