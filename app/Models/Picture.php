<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'avif',
        'orig',
        'medium',
        'small',
        'thumbnail'
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

}
