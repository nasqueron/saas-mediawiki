<?php

namespace Nasqueron\SAAS\MediaWiki\Utilities;

use Nasqueron\SAAS\MediaWiki\Configuration\Instances;
use Nasqueron\SAAS\MediaWiki\Configuration\Settings;
use Nasqueron\SAAS\InstanceNotFoundException;

class GetHost extends Command {

    public const EXIT_HOST_NOT_FOUND = 2;

    public function main () : int {
        if ($this->argc < 2) {
            self::usage();
            return 1;
        }

        try {
            $this->display->out($this->search($this->argv[1]));
        } catch (InstanceNotFoundException $exception) {
            $this->display->error("Host not found.");
            return self::EXIT_HOST_NOT_FOUND;
        }

        return 0;
    }

    public function search (string $needle) : string {
        if (self::isDomain($needle)) {
            return Instances::getCanonicalHost($needle);
        }

        return self::getHostFromAlias($needle);
    }

    public static function isDomain ($string) : bool {
        return strpos($string, ".") !== false;
    }

    public static function getHostFromAlias (string $alias) : string {
        // Map alias to database
        $map = Settings::getDatabaseMap();
        if (isset($map[$alias])) {
            $alias = $map[$alias];
        }

        // Get database from host
        $host = array_search($alias, Instances::getList());
        if ($host === false) {
            throw new InstanceNotFoundException($alias);
        }

        return $host;
    }

    public function usage () : void {
        $commandName = $this->getCommandName();
        $this->display->error("Usage: $commandName <wiki host or alias>");
    }
}
