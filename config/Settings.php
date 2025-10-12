<?php

namespace Nasqueron\SAAS\MediaWiki\Configuration;

use Keruald\OmniTools\DataTypes\Option\None;

class Settings extends MappableSettings {

    static public function getDatabaseMap () : array {
        return [
            'agora' => 'nasqueron_wiki',
            'cosmo' => 'inidal_wiki',
            'wolfplex' => 'wolfplex_wiki',
        ];
    }

    static public function getMappedSettings () : array {
        return [

            ///
            /// Maintenance
            ///

            'saasReadOnly' => [
                'default' => new None,
            ],

            ///
            /// MediaWiki Core
            ///

            'wgAllowTitlesInSVG' => [
                'default' => true,
            ],

            'wgAllowUserCss' => [
                'default' => false,
                'agora' => true, // T1889
            ],

            'wgAllowUserJs' => [
                'default' => false,
                'agora' => true, // T1889
            ],

            'wgDBprefix' => [
                'default' => '',

                // Legacy installations
                'arsmagica' => 'arsm_',
                'utopia' => 'wiki_',
            ],

            'wgDefaultSkin' => [
                'default' => 'vector',
                'agora' => 'timeless',
                'cosmo' => 'timeless',
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

            'wgEnotifUserTalk' => [
                'default' => true,
            ],

            'wgEnotifWatchlist' => [
                'default' => true,
            ],

            'wgExtraNamespaces' => [
                'wolfplex' => [
                    320 => 'Bulletin',
                    321 => 'Discussion_Bulletin',
                    322 => 'Event',
                    323 => 'Discussion_Event',
                ]
            ],

            'wgContentNamespaces' => [
                'wolfplex' => [
                    320, // Bulletin
                    322, // Event
                ],
            ],

            'wgNamespacesToBeSearchedDefault' => [
                'wolfplex' => [
                    NS_MAIN => true,

                    320 => true, // Bulletin
                    322 => true, // Event
                ],
            ],

            'wgUseInstantCommons' => [
                'default' => true,
            ],

            '+wgFileExtensions' => [
                'default' => [
                    'svg',
                ],
                'wolfplex' => [
                    'pdf',
                    'svg',
                ],

            ],

            'wgLanguageCode' => [
                'default' => 'en',
                'arsmagica' => 'fr',
                'utopia' => 'fr',
                'wolfplex' => 'fr',
            ],

            'wgLocalInterwikis' => [
                'agora' => [
                    'agora',
                ],
                'arsmagica' => [
                    'arsm',
                    'arsmagica',
                ],
                'utopia' => [
                    'utopia',
                ],
                'wolfplex' => [
                    'wolfplex',
                ],
            ],

            'wgLogo' => [
                'default' => '/images/b/bc/Wiki.png',
                'agora' => 'https://assets.nasqueron.org/logos/logo-main-133px.png',
                'arsmagica' => '/images/3/33/ArsMagica.png',
                'wolfplex' => '/img/logo135.png',
                'utopia' => '/img/BoatDesaturedBlueUtopiaIcon_135x135.png',
            ],

            'wgMaxImageArea' => [
                'default' => 12_500_000,
                'agora' => 15_000_000, // T1895
            ],

            'wgMetaNamespace' => [
                'default' => false,
                'utopia' => 'Utopia',
                'wolfplex' => 'Wolfplex',
            ],

            '+wgNamespacesWithSubpages' => [
                'wolfplex' => [
                    NS_MAIN => true,
                    320 => true,              // Bulletin
                ],
                'agora' => [
                    NS_MAIN => true,
                ],
            ],

            'wgNoFollowLinks' => [
                'default' => true,
                'agora' => false,
            ],

            'wgPasswordSender' => [
                'default' => 'mediawiki-saas-no-reply@nasqueron.org',
            ],

            'wgRestrictDisplayTitle' => [
                'default' => true,
                'wolfplex' => false,
            ],

            'wgSitename' => [
                'default' => 'Wiki',
                'agora' => 'Nasqueron Agora',
                'arsmagica' => 'Ars Magica',
                'cosmo' => 'Cosmo',
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
                    'sysop' => [
                        'deletelogentry'  => true,
                        'deleterevision'  => true,
                    ],
                ],
                '+agora' => [
                    'confirmed' => [
                        "autoconfirmed" => true,
                        "upload" => true,
                    ],
                ],
                'cosmo' => [
                    '*' => [
                        // Private wiki
                        'read' => false,
                        'edit' => false,
                        'createaccount' => false,
                    ],
                    'sysop' => [
                        'deletelogentry'  => true,
                        'deleterevision'  => true,
                    ],
                ],
                '+utopia' => [
                    'confirmed' => [
                        "autoconfirmed" => true,
                        "upload" => true,
                    ],
                ],
            ],

            'saasLicense' => [
                'default' => 'CC-BY 4.0',
                'utopia' => 'CC-BY-NC-SA 3.0', // T1376
            ],

            'saasUrlScheme' => [
                'default' => 'wiki',
                'agora' => 'root',
                'arsmagica' => 'root',
                'cosmo' => 'root',
            ],

            ///
            /// ContactPage extension
            ///

            'wgContactConfig' => [
                'wolfplex' => [
                    'default' => [
                        "RecipientUser" => 'Spike',
                        "SenderEmail" => null,
                        "SenderName" => "Contact Form on Wolfplex",
                        "RequireDetails" => false,
                        "IncludeIP" => false,
                        "RLModules" => [],
                        "RLStyleModules" => [],
                        "AdditionalFields" => [
                            "Text" => [
                                "label-message" => "emailmessage",
                                "type" => "textarea",
                                "required" => true,
                            ],
                        ],
                    ],
                ],
            ],

            ///
            /// WarnNotRecentlyUpdated extension
            ///

            'wgWarnNotRecentlyUpdatedDelay' => [
                'agora' => 365 * 24 * 3_600, // one year - T1893
            ],

            'wgWarnNotRecentlyUpdatedPages' => [
                'agora' => [
                    NS_MAIN => [
                        "Operations grimoire/" => "old-NOG", // T1893
                    ],
                ],
            ],

            ///
            /// Skins and extensions to load
            ///

            'saasUseExtensionCategoryTree' => [
                'default' => true,
            ],

            'saasUseExtensionCite' => [
                'default' => true,
            ],

            'saasUseExtensionContactPage' => [
                'default' => false,
                'wolfplex' => true,
            ],

            'saasUseExtensionGadgets' => [
                'default' => true,
            ],

            'saasUseExtensionParserFunctions' => [
                'default' => true,
            ],

            'saasUseExtensionPoem' => [
                'default' => true,
            ],

            'saasUseExtensionWarnNotRecentlyUpdated' => [
                'default' => false,
                'agora' => true, // T1893
            ],

            // This extension is already included with Scribunto.
            'saasUseExtensionWikiEditor' => [
                'default' => false,
                'cosmo' => true,
            ],

            'saasUseExtensionWolfplexMessages' => [
                'default' => false,
                'wolfplex' => true,
            ],

            'saasUseSkinMinervaNeue' => [
                'default' => true,
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
