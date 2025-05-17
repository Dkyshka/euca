<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chat_id',
        'inviter_id',
        'name',
        'full_name',
        'username',
        'phone',
        'pinfl',
        'passport_number',
        'email',
        'role_id',
        'status',
        'password',
        'avatar',
        'step',
        'lang',
        'is_confirm',
        'bonus_balance',
        'bonus_invites',
        'login',
        'organization',
        'inn',
        'email_verified_at'
    ];

    /**
     * @var string[]
     */
    protected $with = [
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @return HasOne
     */
    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'id','role_id');
    }

    public function inviter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'inviter_id');
    }

    public function invitees(): HasMany
    {
        return $this->hasMany(User::class, 'inviter_id');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeNotRoleUser(Builder $query): Builder
    {
        return $query->whereNot('role_id', Role::USER);
    }

    public function scopeOnlyAdmin(Builder $query): Builder
    {
        return $query->where('role_id', Role::ADMIN);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeNotRoleAdmin(Builder $query): Builder
    {
        return $query->whereNot('role_id', Role::ADMIN);
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'added_by', 'id');
    }

    // Метод для получения подписок пользователя
    public function subscriptions()
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'user_id', 'subscriber_id')->withTimestamps();
    }

    // Метод для получения подписчиков пользователя
    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'subscriber_id', 'user_id');
    }

    // Метод для подписки на пользователя
    public function subscribe(User $user)
    {
        $this->subscriptions()->attach($user->id);
    }

    // Метод для отписки от пользователя
    public function unsubscribe(User $user)
    {
        $this->subscriptions()->detach($user->id);
    }

    // Метод для проверки подписки пользователя на другого пользователя
    public function isSubscribedTo(User $user)
    {
        return $this->subscriptions()->where('subscriber_id', $user->id)->exists();
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    // Сообщения, которые пользователь отправил
    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Чаты, где пользователь отправитель
    public function sentChats(): HasMany
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    // Чаты, где пользователь получатель
    public function receivedChats(): HasMany
    {
        return $this->hasMany(Chat::class, 'recipient_id');
    }

    // Все чаты, где участвует пользователь (отправитель или получатель)
    public function allChats()
    {
        return Chat::where('sender_id', $this->id)
            ->orWhere('recipient_id', $this->id);
    }
    public function cargoBids(): HasMany
    {
        return $this->hasMany(CargoBid::class);
    }

}
