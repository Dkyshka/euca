<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cargo_loading_id', 'title', 'weight', 'volume', 'weight_type', 'packaging',
        'quantity', 'length', 'width', 'height', 'diameter',
        'ready_date', 'archive_after_days', 'shipment_type',
        'needs_hitch', 'needs_air_suspension', 'needs_koniki', 'truck_count',
        'crew_required', 'adr_classes', 'permits', 'strap_count', 'carrying_capacity',
        'bargain_type', 'rates', 'payments', 'direct_contract', 'constant_frequency',
        'contact_id', 'note', 'package_id',
    ];

    protected $casts = [
        'ready_date' => 'date',
        'adr_classes' => 'array',
        'permits' => 'array',
        'rates' => 'array',
        'payments' => 'array',
        'direct_contract' => 'boolean',
    ];

    public function loading(): BelongsTo
    {
        return $this->belongsTo(CargoLoading::class, 'cargo_loading_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(CargoPhoto::class);
    }

    public function unloadings(): HasMany
    {
        return $this->hasMany(CargoUnloading::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(User::class, 'contact_id');
    }

    protected function dimensions(): Attribute
    {
        return Attribute::get(function () {
            $parts = array_filter([
                $this->length ? $this->length . ' м' : null,
                $this->width ? $this->width . ' м' : null,
                $this->height ? $this->height . ' м' : null,
                $this->diameter ? 'Ø ' . $this->diameter . ' м' : null,
            ]);
            return implode(' × ', $parts);
        });
    }
}
