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
        'currency',
        'is_negotiable',
        'comment',
        'status',
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
