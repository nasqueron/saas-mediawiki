<?php

namespace Nasqueron\SAAS\MediaWiki\Configuration;

///
/// Temporary hack to get clean configuration.
///
/// Plan is to deploy the MediaWiki SaaS on a dedicated node.
///
/// Meanwhile, as we share the main Nasqueron MySQL database,
/// with an history of databases going back to 2001, we need
/// to map nicely named site key to actual databases names.

abstract class MappableSettings {

    abstract static public function getDatabaseMap() : array;
    abstract static public function getMappedSettings() : array;

    static public function getSettings () : array {
        $settings = [];
        foreach (static::getMappedSettings() as $setting => $values) {
            $settings[$setting] = self::mapDatabases($values);
        }
        return $settings;
    }

    static private function mapDatabases ($items) {
        $setting = [];
        foreach ($items as $key => $value) {
            $mappedKey = self::mapDatabase($key);
            $setting[$mappedKey] = $value;
        }
        return $setting;
    }

    static private function mapDatabase ($key) {
        foreach (static::getDatabaseMap() as $canonical => $actual) {
            if ($key === $canonical) {
                return $actual;
            }
        }

        return $key;
    }

}
