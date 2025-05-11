<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'city',
        'address',
        'avatar',
        'website',
        'description',
        'employees_count',
        'user_id',
        'work_start_date',
        'is_featured',
        'is_active',
        'is_favorite'
    ];

    protected $casts = [
        'work_start_date' => 'datetime',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function phones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CompanyPhone::class);
    }

    public function emails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CompanyEmail::class);
    }

    public function certificates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CertificateImage::class);
    }

    public function directions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Direction::class, 'company_direction')->withTimestamps();
    }
}
