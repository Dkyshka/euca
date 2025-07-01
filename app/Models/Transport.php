<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transport extends Model
{
    use HasFactory;

    public const IN_PROGRESS = 1;

    public const COORDINATION = 2;

    public const IN_PERFORMANCE = 3;

    public const STATUSES = [
        self::IN_PROGRESS => 'В работе',
        self::COORDINATION => 'Согласование',
        self::IN_PERFORMANCE => 'В исполнении',
    ];
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
        'status',
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

    public function cargoBids(): HasMany
    {
        return $this->hasMany(CargoBid::class);
    }

}
