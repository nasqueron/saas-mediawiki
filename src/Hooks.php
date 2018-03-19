<?php

namespace Nasqueron\SAAS\MediaWiki;

class Hooks {

    public static function onSiteParameters ($conf, $wiki) {
        $site = null;
        $lang = null;

        foreach ($conf->suffixes as $suffix) {
            if (Configuration::isSelectedWiki($wiki, $suffix)) {
                $site = $suffix;
                $lang = substr( $wiki, 0, -strlen( $suffix ) );
                break;
            }
        }

        return [
            'suffix' => $site,
            'lang' => $lang,
            'params' => [
                'lang' => $lang,
                'site' => $site,
                'wiki' => $wiki,
            ],
            'tags' => [],
        ];
    }

}
