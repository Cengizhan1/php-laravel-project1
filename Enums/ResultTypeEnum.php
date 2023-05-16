<?php

namespace App\Enums;

use ObiPlus\ObiPlus\Enums\Enum;

/**
 * @method static self approved()
 * @method static self not_approved()
 * @method static self re_date()
 */
final class ResultTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'approved' => 0,
            'not_approved' => 1,
            're_date' => 2,
        ];
    }

    protected static function labels(): array
    {
        return [
            'approved' => 'Onaylandı',
            'not_approved' => 'Onaylanmadı',
            're_date' => 'Yeniden tarih ataması yapıldı',
        ];
    }
}
