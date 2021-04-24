<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static NOT_VERIFIED()
 * @method static static VERIFIED()
 */
final class EmailVerificationType extends Enum
{
    const NOT_VERIFIED = 0;
    const VERIFIED = 1;

    /**
     * Get the email verification status
     *
     * @param integer $value
     *
     * @return string
     */
    public static function getStatus(int $value): string
    {
        return match($value)
        {
            self::NOT_VERIFIED => 'not verified',
            self::VERIFIED => 'verified',
        };
    }
}
