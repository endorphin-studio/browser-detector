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
        return sprintf('/%s(\/| )[\w-._]{1,15}/', $phrase);
    }

    public static function getWindowsVersion(string $version, array $config)
    {
        return array_key_exists($version, $config) ? $config[$version] : $version;
    }

    public static function getMethodName(string $name, string $type = 'set')
    {
        return sprintf('%s%s', $type, ucfirst($name));
    }

    public static function runSetter(&$object, string $key, $value)
    {
        $methodName = static::getMethodName($key);
        if (method_exists($object, $methodName)) {
            $object->$methodName($value);
        }
    }

    public static function resolvePath(array &$files, $path)
    {
        if(is_array($path)) {
            $files = \array_merge($files, $path);
        } else {
            $files[] = $path;
        }
        return \array_unique($files);
    }
}