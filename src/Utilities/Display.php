<?php

namespace Nasqueron\SAAS\MediaWiki\Utilities;

abstract class Display {

    abstract function out (string $message) : void;
    abstract function error (string $message) : void;

}
