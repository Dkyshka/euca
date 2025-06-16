<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'user_id',
        'country',
        'final_country',
        'currency',

        'with_vat_cashless',
        'without_vat_cashless',
        'cash',

        'body_type',
        'capacity',
        'volume',
        'length',
        'width',
        'height',

        'origin',
        'unload_zone',
        'payment_type',
        'comment',

        'availability_mode',
        'ready_date',
    ];

    protected $casts = [
        'ready_date' => 'datetime',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function drivers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Driver::class);
    }

    public function driver(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

}
