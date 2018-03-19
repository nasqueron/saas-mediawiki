<?php

use Nasqueron\SAAS\MediaWiki\Service;
use Nasqueron\SAAS\MediaWiki\Environment;

/**
 * The Composer autoloader is used to load required libraries.
 * This service follows PSR-4 conventions.
 *
 * The environment is read from environment variables or an .env file.
 *
 * This entry point check the host and call MediaWiki if it exists.
 * If not, it serves a 404.
 */

require_once __DIR__ . '/vendor/autoload.php';

Environment::load();
$service = Service::preload();

require $service->getEntryPoint();
