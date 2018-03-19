<?php

namespace Nasqueron\SAAS\MediaWiki;

trait WithScribunto {

    public static function enableScribunto () : void {
        self::registerScribuntoExtensions();
        self::registerScribuntoConfiguration();
    }

    private function registerScribuntoConfiguration () : void {
        foreach (self::getScribuntoConfiguration() as $setting => $value) {
            // TODO: use ??= here when available.
            if (!isset($GLOBALS['wg' . $setting])) {
                $GLOBALS['wg' . $setting] = $value;
            }
        }

        $GLOBALS['wgDefaultUserOptions']['usebetatoolbar'] = true;

        if (Environment::isBSD()) {
            $GLOBALS['wgScribuntoEngineConf']['luastandalone']['luaPath']
                = '/usr/local/bin/lua51';
        }
    }

    private static function registerScribuntoExtensions () : void {
        foreach (self::getScribuntoExtensions() as $extension) {
            $GLOBALS['saasUseExtension' . $extension] = true;
        }
    }

    private static function getScribuntoConfiguration () : array {
        return [
            'ScribuntoDefaultEngine' => 'luastandalone',
            'ScribuntoUseGeSHi' => true,
            'ScribuntoUseCodeEditor' => true,
        ];
    }

    private static function getScribuntoExtensions () : array {
        return [
            'WikiEditor',
            'SyntaxHighlight_GeSHi',
            'CodeEditor',
            'Scribunto',
        ];
    }

}
