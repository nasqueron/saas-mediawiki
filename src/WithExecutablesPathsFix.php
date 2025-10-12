<?php

namespace Nasqueron\SAAS\MediaWiki;

trait WithExecutablesPathsFix {

    /**
     * Add settings to set binary paths for executables.
     *
     * By default, MediaWiki hardcodes Linux-centric paths for binaries.
     * Other OSes could store elsewhere binaries, like in /usr/local/bin
     *
     * @param array $settings
     * @param string $path
     */
    public static function fixExecutablePaths (array &$settings, string $path) {
        foreach (self::getExecutables() as $setting => $executable) {
            $settings[$setting]['default'] = $path . '/' . $executable;
        }
    }

    private static function getExecutables (): array {
        return [
            "wgExiftool" => "exiftool",
            "wgExiv2Command" => "exiv2",
            "wgGitBin" => "git",
            "wgImageMagickConvertCommand" => "convert",
            "wgJpegTran" => "jpegtran",
            "wgPhpCli" => "php",
        ];
    }
}
