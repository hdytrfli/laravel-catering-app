<?php

namespace App\Models;

use App\Helpers\Distance;
use App\Enums\CategoryType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Merchant extends Model
{
    /** @use HasFactory<\Database\Factories\MerchantFactory> */
    use HasFactory;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'category' => CategoryType::class,
            'latitude' => 'decimal:6',
            'longitude' => 'decimal:6',
        ];
    }

    /**
     * Get the user object associated with the merchant.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the menus associated with the merchant.
     */
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Getter for the distance property.
     *
     * @return float
     */
    public function getDistanceAttribute(): float
    {
        $customer = Auth::user()->customer;

        if (!$customer) return 0;
        return Distance::haversine(
            $customer->latitude,
            $customer->longitude,
            $this->latitude,
            $this->longitude
        );
    }
}
