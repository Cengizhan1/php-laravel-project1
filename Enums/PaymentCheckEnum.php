<?php

namespace App\Enums;

use ObiPlus\ObiPlus\Enums\Enum;

/**
 * @method static self created()
 * @method static self success()
 * @method static self error()
 */
final class PaymentCheckEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'created' => 0,
            'success' => 1,
            'error' => 2,
        ];
    }

    protected static function labels(): array
    {
        return [
            'created' => 'Oluşturuldu',
            'success' => 'Başarılı',
            'error' => 'Başarısız',
        ];
    }
}
