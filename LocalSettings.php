<?php

#   -------------------------------------------------------------
#   Configuration for Nasqueron MediaWiki SaaS
#   - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
#   Project:        Nasqueron
#   Created:        2018-03-19
#   License:        Trivial work, not eligible to copyright
#   -------------------------------------------------------------

use Nasqueron\SAAS\MediaWiki\Configuration\CommonSettings;
use Nasqueron\SAAS\MediaWiki\Service;
use Nasqueron\SAAS\MediaWiki\Environment;

require_once __DIR__ . '/vendor/autoload.php';

#   -------------------------------------------------------------
#   Load service and configuration
#   - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

Environment::load();
$service = Service::preload();
$service->run();
$serviceConfiguration = $service->getConfiguration();

$wgLocalDatabases = $serviceConfiguration->getLocalDatabases();

$wgConf->wikis = $wgLocalDatabases;
$wgConf->localVHosts = [ 'localhost' ];
$wgConf->settings = $serviceConfiguration->getSettings();
$wgConf->suffixes = $wgLocalDatabases;
$wgConf->siteParamsCallback = 'Nasqueron\SAAS\MediaWiki\Hooks::onSiteParameters';

#   -------------------------------------------------------------
#   Database settings
#   - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

$wgDBname = $serviceConfiguration->getSelectedDatabase();

$wgDBserver = $_ENV['DB_HOST'];
$wgDBuser = $_ENV['DB_USER'];
$wgDBpassword = $_ENV['DB_PASS'];

#   -------------------------------------------------------------
#   Fixes needed before extracting settings
#
#   :: Fix executable paths, by default Linux-centric
#   - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

if (Environment::isBSD()) {
    CommonSettings::fixExecutablePaths($wgConf->settings, "/usr/local/bin");
}

#   -------------------------------------------------------------
#   Populate the global spaces with settings
#   - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

$wgConf->extractAllGlobals( $wgDBname );

#   -------------------------------------------------------------
#   Fixes needed after extractings ettings
#
#   :: Group permissions
#   :: Settings with common configuration
#   - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

CommonSettings::fixGroupPermissions($saasExtraGroupPermissions);

if ($saasUseScribunto) {
    CommonSettings::enableScribunto();
}

CommonSettings::enableLog();

#   -------------------------------------------------------------
#   Paths and settings defined in environment
#   - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

$wgScript = "{$wgScriptPath}/index.php";
$wgSecretKey = $_ENV["MEDIAWIKI_SECRET_KEY"];

$wgServer = "https://" . $service->getHost();

$wgCacheDirectory = $serviceConfiguration->getCacheDir();
$wgFileCacheDirectory = $wgCacheDirectory . "/pages";
$wgUploadDirectory = $serviceConfiguration->getDataStoreDir() . "/images";

#   -------------------------------------------------------------
#   Load extensions and skins
#   - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

wfLoadExtensions($serviceConfiguration->getResources('Extension'));
wfLoadSkins($serviceConfiguration->getResources('Skin'));
