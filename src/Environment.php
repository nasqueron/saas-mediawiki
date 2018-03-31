<?php

namespace Nasqueron\SAAS\MediaWiki;

use Dotenv\Dotenv;
use Dotenv\Exception\ValidationException;

class Environment {

    /**
     * @var bool
     */
    static private $isLoaded = false;

    /**
     * Loads the environment, if it hasn't been loaded before.
     */
    public static function load () : void {
        if (!self::$isLoaded) {
            $directory = self::getDirectory();
            $dotenv = new Dotenv($directory);
            $dotenv->safeLoad();
            try {
                $dotenv->required(self::getRequiredVariables());
            } catch (ValidationException $exception) {
                Service::serveInternalErrorResponse($exception);
            }
            self::$isLoaded = true;
        }
    }

    public static function isLoaded () : bool {
        return self::$isLoaded;
    }

    public static function get ($variableName, $defaultValue = "") : string {
        return $_ENV[$variableName] ?? $defaultValue;
    }

    private static function getDirectory () : string {
        return dirname(__DIR__);
    }

    private static function getRequiredVariables () : array {
        return [
            'MEDIAWIKI_ENTRY_POINT',
            'MEDIAWIKI_SECRET_KEY',
            'DB_HOST',
            'DB_USER',
            'DB_PASS',
        ];
    }

    public static function isBSD () : bool {
        static $system;
        $system = php_uname("s");
        return substr($system, -3) === "BSD" || $system === "DragonFly";
    }
}
