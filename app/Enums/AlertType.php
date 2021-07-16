<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ALERT_CLASS()
 * @method static static SUCCESS()
 * @method static static DANGER()
 * @method static static MESSAGE()
 */
final class AlertType extends Enum
{
    const ALERT_CLASS = 'alert-class';
    const SUCCESS = 'alert-success';
    const DANGER = 'alert-danger';
    const MESSAGE = 'message';
}
