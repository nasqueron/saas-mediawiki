<?php
declare(strict_types=1);

namespace Nasqueron\SAAS\MediaWiki;

/*
 * Levels should be aligned with monolog library Level enum.
 */

enum LogLevel: int {
    case Debug = 100;
    case Info = 200;
    case Notice = 250;
    case Warning = 300;
    case Error = 400;
    case Critical = 500;
    case Alert = 550;
    case Emergency = 600;
}
