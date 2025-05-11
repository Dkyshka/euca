<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CargoLoading extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'country_id', 'country', 'address', 'time_at', 'time_to', 'is_24h',
        'final_unload_date_from', 'final_unload_date_to',
        'is_archived', 'is_approved', 'is_top',
        'final_unload_city', 'final_unload_country_id', 'final_unload_country', 'final_unload_address',
        'final_unload_datetime_from', 'final_unload_datetime_to', 'final_is_24h',
        'body_types', 'loading_types', 'unloading_types', 'payment_type',
        'with_vat_cashless', 'without_vat_cashless', 'cash', 'on_cart',
        'counter_offers', 'currency', 'payment_via', 'contact_id', 'note', 'status',
    ];

    protected $casts = [
        'body_types' => 'array',
        'loading_types' => 'array',
        'unloading_types' => 'array',
        'is_archived' => 'boolean',
        'is_approved' => 'boolean',
        'is_top' => 'boolean',
        'on_cart' => 'boolean',
        'counter_offers' => 'boolean',
        'final_unload_datetime_from' => 'datetime',
        'final_unload_datetime_to' => 'datetime',
        'final_unload_date_from' => 'datetime',
        'final_unload_date_to' => 'datetime',
        'time_at' => 'datetime:H:i',
        'time_to' => 'datetime:H:i',
        'final_is_24h' => 'boolean',
        'is_24h' => 'boolean',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function finalUnloadCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'final_unload_country_id');
    }

    public function cargos(): HasMany
    {
        return $this->hasMany(Cargo::class);
    }

    public function cargo(): HasOne
    {
        return $this->hasOne(Cargo::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(User::class, 'contact_id');
    }
}
