<?php

namespace App\Enums;

use ObiPlus\ObiPlus\Enums\Enum;

/**
 * @method static self superAdmin()
 * @method static self admin()
 * @method static self moderator()
 */
final class AdminRoleEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'superAdmin' => 0,
            'admin' => 1,
            'moderator' => 2,
        ];
    }

    protected static function labels(): array
    {
        return [
            'superAdmin' => 'Super Admin',
            'admin' => 'Admin',
            'moderator' => 'Moderator',
        ];
    }
}
