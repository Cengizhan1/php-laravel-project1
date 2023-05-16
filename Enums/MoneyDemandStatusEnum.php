<?php

namespace App\Enums;

use ObiPlus\ObiPlus\Enums\Enum;

/**
 * @method static self approved()
 * @method static self not_approved()
 * @method static self requested()
 */
final class MoneyDemandStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'approved' => 0,
            'not_approved' => 1,
            'requested' => 2,
        ];
    }

    protected static function labels(): array
    {
        return [
            'approved' => 'Onaylandı',
            'not_approved' => 'Onaylanmadı',
            'requested' => 'Talep edildi',
        ];
    }
}
