<?php

namespace Nasqueron\SAAS\MediaWiki;

use Nasqueron\SAAS\MediaWiki\Configuration\CommonSettings;
use Nasqueron\SAAS\MediaWiki\Configuration\Instances;
use Nasqueron\SAAS\MediaWiki\Configuration\Settings;

class Configuration {

    /**
     * @var string
     */
    private $host;

    public function __construct (string $host) {
        $this->host = $host;
    }

    public function getLocalDatabases () : array {
        return array_values(Instances::getList());
    }

    public function getSettings () : array {
        // wg… keys
        $settings = Settings::getSettings();

        // saas… → wg… keys
        CommonSettings::mapSettings($settings);

        return $settings;
    }

    public function getResources (string $type) : array {
        // saasUse<type><resource name>
        // e.g. saasUseExtensionCite or saasUseSkinTimeless

        $resources = [];

        $prefix = "saasUse" . $type;
        $len = strlen($prefix);
        foreach ($GLOBALS as $key => $value) {
            if (substr($key, 0, $len) === $prefix && $value) {
                $resources[] = substr($key, $len);
            }
        }

        return $resources;
    }

    public function getCacheDir () {
        $cacheRootDir = Environment::get("CACHE_DIRECTORY", "/var/cache/mediawiki");
        return $cacheRootDir . '/' . $this->host;
    }

    public function getDataStoreDir () {
        $dataStoreDir = Environment::get("DATASTORE_DIRECTORY", "/var/dataroot");
        return $dataStoreDir . '/' . $this->host;
    }

    /**
     * @throws \Nasqueron\SAAS\InstanceNotFoundException
     */
    public function getSelectedDatabase () {
        return Instances::getDatabaseFromHost($this->host);
    }

    ///
    /// Helper methods
    ///

    public static function isSelectedWiki (string $wiki, string $suffix) : bool {
        return substr($wiki, -strlen($suffix)) == $suffix;
    }

}
