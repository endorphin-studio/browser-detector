<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project browser-detector
 */

namespace EndorphinStudio\Detector;

class Tools
{
    public static function getVersion(string $phrase, string $ua): string
    {
        $version = static::getVersionPattern($phrase);
        $uaString = str_replace(' NT', '', $ua);
        if (preg_match($version, $uaString)) {
            preg_match($version, $uaString, $v);
            $version = $v[0];
            $version = preg_replace('/' . $phrase . '/', '', $version);
            $version = str_replace(';', '', $version);
            $version = str_replace(' ', '', $version);
            $version = str_replace('/', '', $version);
            $version = str_replace('_', '.', $version);

            return $version;
        }
    }

    public static function getVersionPattern(string $phrase): string
    {
        return sprintf('\'/\'%s\'(\/| )[\w-._]{1,15}/\'', $phrase);
    }

    public static function getWindowsVersion(string $version, array $config)
    {
        return array_key_exists($version, $config) ? $config[$version] : $version;
    }
}