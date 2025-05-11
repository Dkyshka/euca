<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPhone extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'company_id']; // Заполняемые поля

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
