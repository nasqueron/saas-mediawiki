<?php

namespace Nasqueron\SAAS\MediaWiki\Configuration;

use Nasqueron\SAAS\MediaWiki\InstancesRepository;

class Instances extends InstancesRepository {

    static public function getList () : array {
        return [
            // Format: => database name

            "agora.nasqueron.org" => "nasqueron_wiki",
            "arsmagica.espace-win.org" => "arsmagica",
            "utopia.espace-win.org" => "utopia",
            "www.wolfplex.org" => "wolfplexdb",
        ];
    }

    static public function getAliases () : array {
        return [
            // Format: Database => [ hosts ]

            "wolfplexdb" => [
                "www.wolfplex.be",
                "wiki.wolfplex.org",
                "wiki.wolfplex.be",
            ]
        ];
    }

}
