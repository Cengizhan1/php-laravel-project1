<?php

namespace App\Enums;

use ObiPlus\ObiPlus\Enums\Enum;

/**
 * @method static self waiting()
 * @method static self done()
 */
final class WalletTransactionEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'waiting' => 0,
            'done' => 1,
        ];
    }

    protected static function labels(): array
    {
        return [
            'waiting' => 'Beklemede',
            'done' => 'Aktarıldı',
        ];
    }
}
