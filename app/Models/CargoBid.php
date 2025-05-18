<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CargoBid extends Model
{
    use HasFactory;

    protected $fillable = [
        'cargo_loading_id',
        'user_id',
        'price',
        'with_vat_cashless',
        'without_vat_cashless',
        'cash',
        'currency',
        'comment',
        'status',
        'is_prepayment',
        'prepayment_percent',
        'is_on_unloading',
        'is_bank_transfer',
        'bank_transfer_days',
        'payment_comment',
        'ready_date',
    ];

    public const PENDING = 'pending';

    public const ACCEPTED = 'accepted';

    public const DECLINED = 'declined';

    public const FINISHED = 'finished';

    public const STATUSES = [
        self::PENDING => 'В ожидании',
        self::ACCEPTED => 'Принял',
        self::DECLINED => 'Отклоненный',
        self::FINISHED => 'Завершенный',
    ];

    public function cargoLoading(): BelongsTo
    {
        return $this->belongsTo(CargoLoading::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
