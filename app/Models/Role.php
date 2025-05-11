<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'alias'
    ];

    public const USER = 1;

    public const ADMIN = 2;

    public const DEVELOPER = 3;

    public const CARRIER  = 4;

    public const CONSIGNOR  = 5;

    public const ROLES = [
        self::USER => 'user',
        self::ADMIN => 'admin',
        self::DEVELOPER => 'developer',
        self::CARRIER => 'carrier',
        self::CONSIGNOR => 'consignor',
    ];

    public const ALIASES  = [
        self::USER        => 'Пользователь',
        self::ADMIN       => 'Администратор',
        self::DEVELOPER   => 'Разработчик',
        self::CARRIER   => 'Перевозчик',
        self::CONSIGNOR   => 'Грузовладелец',
    ];

    public function isUser(): bool
    {
        return $this->id === self::USER;
    }

    public function isAdmin(): bool
    {
        return $this->id === self::ADMIN;
    }

    public function isDeveloper(): bool
    {
        return $this->id === self::DEVELOPER;
    }

    public function isCarrier(): bool
    {
        return $this->id === self::CARRIER;
    }

    public function isConsignor(): bool
    {
        return $this->id === self::CONSIGNOR;
    }
}
