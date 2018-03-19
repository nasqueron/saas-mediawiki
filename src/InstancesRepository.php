<?php

namespace Nasqueron\SAAS\MediaWiki;

use Nasqueron\SAAS\InstanceNotFoundException;

abstract class InstancesRepository {

    ///
    /// Repository data methods
    ///

    abstract static public function getList () : array;
    abstract static public function getAliases () : array;

    ///
    /// Helper methods
    ///

    /**
     * @throws InstanceNotFoundException
     */
    public static function getCanonicalHost (string $host) : string {
        $canonicalList = static::getList();

        // Case 1 - the host is canonical
        if (array_key_exists($host, $canonicalList)) {
            return $host;
        }

         // Case 2 - the host is an alias
        foreach (static::getAliases() as $database => $vhosts) {
            if (in_array($host, $vhosts)) {
                return array_search($database, $canonicalList);
            }
        }

        throw new InstanceNotFoundException($host);
    }

    /**
     * @throws InstanceNotFoundException
     */
    public static function getDatabaseFromHost (string $host) : string {
        $canonicalHost = self::getCanonicalHost($host);
        return static::getList()[$canonicalHost];
    }

}
