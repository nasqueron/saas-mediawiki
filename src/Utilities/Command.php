<?php

namespace Nasqueron\SAAS\MediaWiki\Utilities;

abstract class Command {

    public const EXIT_SUCCESS = 0;
    public const EXIT_FAILURE = 1;

    /**
     * @var int
     */
    protected $argc;

    /**
     * @var int
     */
    protected $argv;

    /**
     * @var \Nasqueron\SAAS\MediaWiki\Utilities\Display
     */
    protected $display;

    public function __construct (int $argc, array $argv, Display $display = null) {
        $this->argc = $argc;
        $this->argv = $argv;

        if ($display === null) {
            $display = new OutputDisplay();
        }
        $this->display = $display;
    }

    public static function run (int $argc, array $argv) : int {
        $command = new static($argc, $argv);
        return $command->main();
    }

    public function getCommandName () : string {
        return $this->argv[0];
    }

    ///
    /// Methods to implement
    ///

    public abstract function main () : int;

}
