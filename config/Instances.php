<?php

namespace Nasqueron\SAAS\MediaWiki\Configuration;

use Nasqueron\SAAS\MediaWiki\InstancesRepository;

class Instances extends InstancesRepository {

    static public function getList () : array {
        return [
            // Format: => database name

            "agora.nasqueron.org" => "nasqueron_wiki",
            "arsmagica.espace-win.org" => "arsmagica",
            'cosmo.espace-win.org' => 'inidal_wiki',
            "utopia.espace-win.org" => "utopia",
            "www.wolfplex.org" => "wolfplex_wiki",
            'wikis.nasqueron.org' => 'wikis',
        ];
    }

    static public function getAliases () : array {
        return [
            // Format: Database => [ hosts ]

            "wolfplex_wiki" => [
                "www.wolfplex.be",
                "wiki.wolfplex.org",
                "wiki.wolfplex.be",
            ],

            "wikis" => [
                'mediawiki.test.ook.space',
            ],
        ];
    }

}
