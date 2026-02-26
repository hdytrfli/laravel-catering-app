<?php

namespace App\Enums;

enum RoleType: string
{
    case MERCHANT = 'merchant';
    case CUSTOMER = 'customer';

    /**
     * Get the array of values for the enum.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get the label for the specified role type.
     */
    public function label(): string
    {
        return match ($this) {
            self::MERCHANT => 'Merchant',
            self::CUSTOMER => 'Customer',
        };
    }

    /**
     * Get the description for the specified role type.
     */
    public function description(): string
    {
        return match ($this) {
            self::MERCHANT => 'Catering Merchant Role',
            self::CUSTOMER => 'Catering Customer Role',
        };
    }

    /**
     * Get the color for the specified role type.
     */
    public function color(): string
    {
        return match ($this) {
            self::MERCHANT => 'bg-indigo-500',
            self::CUSTOMER => 'bg-green-500',
        };
    }
}
