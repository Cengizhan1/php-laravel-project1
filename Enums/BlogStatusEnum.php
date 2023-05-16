<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self active()
 * @method static self passive()
 */
final class BlogStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'passive' => 0,
            'active' => 1,
        ];
    }

    protected static function labels(): array
    {
        return [
            'active' => 'Aktif',
            'passive' => 'Pasif',
        ];
    }
}
