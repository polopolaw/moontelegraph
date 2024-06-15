<?php

namespace App\Models;

use DefStudio\Telegraph\Models\TelegraphBot as BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TelegraphBot extends BaseModel
{
    protected $fillable = [
        'name',
        'token',
    ];

    protected $casts = [
        'token' => 'encrypted',
    ];

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * Override for managing encrypted bot tokens
     */
    public static function fromToken(string $token): BaseModel
    {
        return static::query()
            ->where('id', $token)
            ->firstOrFail();
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
