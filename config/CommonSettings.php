<?php

namespace Nasqueron\SAAS\MediaWiki\Configuration;

use Keruald\OmniTools\DataTypes\Option\Option;
use Nasqueron\SAAS\ConfigurationException;
use Nasqueron\SAAS\MediaWiki\WithExecutablesPathsFix;
use Nasqueron\SAAS\MediaWiki\WithLog;
use Nasqueron\SAAS\MediaWiki\WithScribunto;

class CommonSettings {

    use WithExecutablesPathsFix;
    use WithScribunto;
    use WithLog;

    const CACHE_NONE = 0;

    ///
    /// Individual set of settings
    ///

    /**
     * @throws ConfigurationException
     */
    private static function getRightsSettings (array $licenses) : array {
        $settings = [];
        foreach ($licenses as $key => $license) {
            switch ($license) {
                case 'CC-BY 4.0':
                    $settings['wgRightsUrl'][$key] = 'https://creativecommons.org/licenses/by/4.0/';
                    $settings['wgRightsText'][$key] = 'Creative Commons Attribution 4.0 International License';
                    $settings['wgRightsIcon'][$key] = 'https://i.creativecommons.org/l/by/4.0/88x31.png';
                    break;

                case 'CC-BY-NC-SA 3.0':
                    $settings['wgRightsUrl'][$key] = 'https://creativecommons.org/licenses/by-nc-sa/3.0/';
                    $settings['wgRightsText'][$key] = 'Attribution-NonCommercial-ShareAlike 3.0 Unported';
                    $settings['wgRightsIcon'][$key] = 'https://licensebuttons.net/l/by-nc-sa/3.0/88x31.png';
                    break;

                default:
                    throw new ConfigurationException("License unknown: $license");
            }
        }
        return $settings;
    }

    private static function getUrlSettings (array $schemes) : array {
        $settings = [];
        foreach ($schemes as $key => $scheme) {
            switch ($scheme) {
                case 'root':
                    $settings['wgArticlePath'][$key] = '/$1';
                    $settings['wgScriptPath'][$key] = '';
                    break;

                case 'wiki':
                    $settings['wgArticlePath'][$key] = '/wiki/$1';
                    $settings['wgScriptPath'][$key] = '/w';
                    break;

                default:
                    throw new ConfigurationException(
                        "Unknown URL scheme: $scheme"
                    );
            }
        }
        return $settings;
    }

    /**
     * Replace default permissions by custom permissions.
     */
    public static function fixGroupPermissions ($groupPermissionsToOverride) {
        // Code from WMF wmf-config/CommonSettings.php (groupOverrides)

        // PHP array merge keep value already defined, but here we want to
        // override those values by the new ones.

        global $wgGroupPermissions;

        foreach ($groupPermissionsToOverride as $group => $permissions) {
            if (!array_key_exists( $group, $wgGroupPermissions)) {
                $wgGroupPermissions[$group] = [];
            }

            $wgGroupPermissions[$group] = $permissions
                                        + $wgGroupPermissions[$group];
        }
    }

    /**
     * Set the wiki in read-only mode
     */
    public static function setReadOnly (Option $readOnlyMessage) : void {
        if ($readOnlyMessage->isNone() || PHP_SAPI === "cli") {
            return;
        }

        global $wgReadOnly;
        global $wgMessageCacheType;
        global $wgMainCacheType;
        global $wgParserCacheType;
        global $wgSessionCacheType;
        global $wgLocalisationCacheConf;
        global $wgIgnoreImageErrors;

        $wgReadOnly = $readOnlyMessage->getValue();

        // DB caching
        $wgMessageCacheType = self::CACHE_NONE;
        $wgMainCacheType = self::CACHE_NONE;
        $wgParserCacheType = self::CACHE_NONE;
        $wgSessionCacheType = self::CACHE_NONE;
        $wgLocalisationCacheConf["storeClass"] = "LCStoreNull";

        // Thumbnails
        $wgIgnoreImageErrors = true;
    }

    ///
    /// Helper methods to apply those settings fix
    ///

    /**
     * @throws ConfigurationException
     */
    public static function mapSettings (array &$settings) : void {
        $settings += self::getMappedSettings($settings);
    }

    /**
     * @throws ConfigurationException
     */
    public static function getMappedSettings (array $settings) : array {
        $mappedSettings = [];
        $mappedSettings += self::getRightsSettings($settings['saasLicense']);
        $mappedSettings += self::getUrlSettings($settings['saasUrlScheme']);
        return $mappedSettings;
    }

}
