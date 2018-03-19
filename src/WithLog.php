<?php

namespace Nasqueron\SAAS\MediaWiki;

trait WithLog {

    public static function enableLog () : void {
        $GLOBALS['wgMWLoggerDefaultSpi'] = self::getLoggerConfiguration();
    }

     private static function getLogPath () : string {
        return "/var/log/mediawiki/error.log";
    }

     private static function getLoggerConfiguration () : array {
        // See https://www.mediawiki.org/wiki/Manual:MonologSpi
        return [
            'class' => '\\MediaWiki\\Logger\\MonologSpi',
            'args' => [[
                'loggers' => [
                    '@default' => [
                        'processors' => [
                            'wiki',
                            'psr',
                            'web',
                            // Disable introspection if you use an handler like
                            // FingersCrossedHandler with several log entries.
                            'introspection',
                        ],
                        'handlers' => [
                            'stream',
                        ],
                    ],
                ],
                'processors' => [
                    'wiki' => [
                        'class' => '\\MediaWiki\\Logger\\Monolog\\WikiProcessor',
                    ],
                    'psr' => [
                        'class' => '\\Monolog\\Processor\\PsrLogMessageProcessor',
                    ],
                    'web' => [
                        'class' => '\\Monolog\\Processor\\WebProcessor',
                    ],
                    'introspection' => [
                        'class' => '\\Monolog\\Processor\\IntrospectionProcessor',
                    ],
                ],
                'handlers' => [
                    'stream' => [
                        'class' => '\\Monolog\\Handler\\StreamHandler',
                        'args' => [ self::getLogPath() ],
                        'formatter' => 'line',
                    ],
                ],
                'formatters' => [
                    'line' => [
                        'class' => '\\Monolog\\Formatter\\LineFormatter'
                    ],
                ],
            ]],
        ];
    }

}
