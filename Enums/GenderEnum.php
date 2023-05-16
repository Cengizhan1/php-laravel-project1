<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self male()
 * @method static self female()
 */
final class GenderEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'male' => 0,
            'female' => 1,
        ];
    }

    protected static function labels(): array
    {
        return [
            'male' => 'Erkek',
            'female' => 'Kadın',
        ];
    }
}
