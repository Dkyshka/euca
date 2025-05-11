<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyEmail extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'company_id'];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
