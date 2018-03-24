<?php

namespace Nasqueron\SAAS\MediaWiki\Configuration;

class Settings extends MappableSettings {

    static public function getDatabaseMap () : array {
        return [
            'agora' => 'nasqueron_wiki',
            'wolfplex' => 'wolfplexdb',
        ];
    }

    static public function getMappedSettings () : array {
        return [

            ///
            /// MediaWiki Core
            ///

            'wgAllowTitlesInSVG' => [
                'default' => true,
            ],

            'wgDBprefix' => [
                'default' => '',

                // Legacy installations
                'arsmagica' => 'arsm_',
                'utopia' => 'wiki_',
                'wolfplex' => 'mw_', // shared database
            ],

            'wgDefaultSkin' => [
                'default' => 'vector',
                'agora' => 'timeless',
                // TODO: find utopia skin
            ],

            'wgEnableCreativeCommonsRdf' => [
                'default' => true,
            ],

            'wgEnableDublinCoreRdf' => [
                'default' => true,
            ],

            'wgEnableUploads' => [
                'default' => false,
                'agora' => true,
                'wolfplex' => true,
            ],

            'wgExtraNamespaces' => [
                'wolfplex' => [
                    320 => 'Bulletin',
                    322 => 'Event',
                ]
            ],

            'wgUseInstantCommons' => [
                'default' => true,
            ],

            '+wgFileExtensions' => [
                'default' => [
                    'svg',
                ]
            ],

            'wgLanguageCode' => [
                'default' => 'en',
                'arsmagica' => 'fr',
                'utopia' => 'fr',
                'wolfplex' => 'fr',
            ],

            'wgLogo' => [
                'default' => '/images/b/bc/Wiki.png',
                'agora' => 'https://assets.nasqueron.org/logos/logo-main-133px.png',
                'wolfplex' => '/img/logo135.png',
            ],

            'wgMetaNamespace' => [
                'default' => false,
                'utopia' => 'Utopia',
                'wolfplex' => 'Wolfplex',
            ],

            'wgNamespacesWithSubpages' => [
                'wolfplex' => [
                    NS_MAIN => true,
                ],
                'agora' => [
                    NS_MAIN => true,
                ],
            ],

            'wgPasswordSender' => [
                'default' => 'mediawiki-saas-no-reply@nasqueron.org',
            ],

            'wgSitename' => [
                'default' => 'Wiki',
                'agora' => 'Nasqueron Agora',
                'arsmagica' => 'Ars Magica',
                'utopia' => 'Utopia',
                'wolfplex' => 'Wolfplex',
            ],

            'wgSVGConverter' => [
                'default' => 'rsvg',
            ],

            'wgUseFileCache' => [
                'default' => false,
            ],

            'wgUseGzip' => [
                'default' => true,
            ],

            'wgUseImageMagick' => [
                'default' => true,
            ],

            'wgUsePathInfo' => [
                // Per https://www.dereckson.be/blog/2013/10/24/mediawiki-nginx-configuration-file/
                'default' => true,
            ],

            'saasExtraGroupPermissions' => [
                'default' => [
                    '*' => [
                        'edit' => false,
                        'createaccount' => false,
                    ],
                ]
            ],

            'saasLicense' => [
                'default' => 'CC-BY 4.0',
            ],

            'saasUrlScheme' => [
                'default' => 'wiki',
                'agora' => 'root',
                'arsmagica' => 'root',
            ],

            ///
            /// Skins and extensions
            ///

            'saasUseExtensionCite' => [
                'default' => true,
            ],

            'saasUseExtensionParserFunctions' => [
                'default' => true,
            ],

            'saasUseExtensionPoem' => [
                'default' => true,
            ],

            'saasUseExtensionWolfplexMessages' => [
                'default' => false,
                'wolfplex' => true,
            ],

            'saasUseSkinMonoBook' => [
                'default' => true,
            ],

            'saasUseSkinVector' => [
                'default' => true,
            ],

            'saasUseSkinTimeless' => [
                'default' => true,
            ],

            'saasUseScribunto' => [
                'default' => false,
                'agora' => true,
                'wolfplex' => true,
            ],
        ];
    }

}
