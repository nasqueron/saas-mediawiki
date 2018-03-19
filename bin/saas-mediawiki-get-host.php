#!/usr/bin/env php
<?php

use Nasqueron\SAAS\MediaWiki\Utilities\GetHost;

require_once __DIR__ . '/../vendor/autoload.php';

$exitCode = GetHost::run($argc, $argv);
exit($exitCode);
