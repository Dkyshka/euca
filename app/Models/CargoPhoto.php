<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['cargo_id', 'path'];

    public function cargo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cargo::class);
    }
}
