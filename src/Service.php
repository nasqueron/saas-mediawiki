<?php

namespace Nasqueron\SAAS\MediaWiki;

use Nasqueron\SAAS\InstanceNotFoundException;
use Nasqueron\SAAS\SaaSException;
use Nasqueron\SAAS\Service as BaseService;
use Nasqueron\SAAS\MediaWiki\Configuration\Instances;

use Exception;

class Service extends BaseService {

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $canonicalHost = "";

    /**
     * @var Configuration
     */
    private $configuration = null;

    /**
     * @var Service
     */
    private static $service = null;

    public function __construct (string $host = '') {
        $this->host = $host ?: self::getServerHost();
    }

    /**
     * @return Service
     */
    public static function preload()
    {
        if (self::$service === null) {

            self::$service = new self;
            try {
                self::$service
                    ->handleAliveRequest()
                    ->handleNotExistingSite();
            } catch (SaaSException $exception) {
                self::$service->serveNotAvailableResponse();
            }
        }

        return self::$service;

    }

    public function getHost () : string {
        return $this->host;
    }

    public function run () : void {
        $this->decorateHeaders();
    }

    public function isExisting () : bool {
        try {
            Instances::getDatabaseFromHost($this->host);
        } catch (InstanceNotFoundException $exception) {
            return false;
        }

        return true;
    }

    private function decorateHeaders () : void {
        header("SaaS-Host: " . $this->host);
        header("SaaS-Canonical-Host: " . $this->getCanonicalHost());
        header("SaaS-App: MediaWiki");
    }

    public function serveNotExistingResponse() : void {
        header("HTTP/1.0 404 Not Found");

        require __DIR__  . '/../views/404.php';
        die;
    }

    public function serveNotAvailableResponse() : void {
        header("HTTP/1.0 503 Service Unavailable");

        require __DIR__  . '/../views/503.php';
        die;
    }

    public static function serveInternalErrorResponse(Exception $exception) : void {
        header("HTTP/1.0 500 Internal Error");

        require __DIR__  . '/../views/500.php';
        die;
    }

    public function getEntryPoint() : string {
        return $_ENV['MEDIAWIKI_ENTRY_POINT'];
    }

    public function getConfiguration() : Configuration {
        if ($this->configuration === null) {
            $this->configuration = new Configuration($this->getCanonicalHost());
        }

        return $this->configuration;
    }

    public function getCanonicalHost () : string {
        if ($this->canonicalHost === "") {
            $this->canonicalHost = Instances::getCanonicalHost($this->getHost());
        }

        return $this->canonicalHost;
    }

}
