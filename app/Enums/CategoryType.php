<?php

namespace App\Enums;

enum CategoryType: string
{
    case INDONESIAN = 'indonesian';
    case PADANG = 'padang';
    case JAVANESE = 'javanese';
    case SUNDA = 'sundanese';
    case BETAWI = 'betawi';
    case MANADO = 'manado';
    case BALINESE = 'balinese';
    case CHINESE = 'chinese';
    case JAPANESE = 'japanese';
    case KOREAN = 'korean';
    case WESTERN = 'western';

    /**
     * Get the array of values for the enum.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get the label for the specified category type.
     */
    public function label(): string
    {
        return match ($this) {
            self::INDONESIAN => 'Indonesian',
            self::PADANG => 'Padang',
            self::JAVANESE => 'Javanese',
            self::SUNDA => 'Sundanese',
            self::BETAWI => 'Betawi',
            self::MANADO => 'Manado',
            self::BALINESE => 'Balinese',
            self::CHINESE => 'Chinese',
            self::JAPANESE => 'Japanese',
            self::KOREAN => 'Korean',
            self::WESTERN => 'Western',
        };
    }

    /**
     * Get the description for the specified category type.
     */
    public function description(): string
    {
        return match ($this) {
            self::INDONESIAN => 'Traditional cuisines from across Indonesia with diverse regional flavors and cultural influences.',
            self::PADANG => 'Cuisine from West Sumatra, Indonesia, known for its bold and spice-rich character.',
            self::JAVANESE => 'Traditional cuisine from Java, Indonesia, with a balanced and subtly sweet profile.',
            self::SUNDA => 'Cuisine from West Java, Indonesia, recognized for its fresh and light flavor balance.',
            self::BETAWI => 'Traditional cuisine of Jakarta, Indonesia, shaped by diverse cultural influences.',
            self::MANADO => 'Cuisine from North Sulawesi, Indonesia, featuring vibrant and aromatic flavors.',
            self::BALINESE => 'Traditional cuisine from Bali, Indonesia, known for its complex spice blends.',
            self::CHINESE => 'Cuisine originating from China with refined techniques and balanced flavors.',
            self::JAPANESE => 'Cuisine from Japan emphasizing precision, simplicity, and ingredient quality.',
            self::KOREAN => 'Cuisine from South Korea characterized by bold and dynamic flavor profiles.',
            self::WESTERN => 'Cuisine from Europe and the Americas rooted in classical and modern culinary traditions.',
        };
    }

    /**
     * Get the color for the specified category type.
     */
    public function color(): string
    {
        return 'bg-primary-500';
    }
}
