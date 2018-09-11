<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Exception;

/**
 * Exception for Storage
 * Class StorageException
 * @package EndorphinStudio\Detector\Exception
 */
class StorageException extends \Exception
{
    /**
     * Message for exception
     */
    const DIRECTORY_NOT_FOUND = '%s is not directory or not exists';

    /**
     * @var string Path to directory
     */
    private $directory;

    /**
     * @var string Classname of Storage Provider
     */
    private $provider;

    /**
     * Get path to directory which Storage Provider try to load
     * @return string Path to directory
     */
    public function getDirectory(): string
    {
        return $this->directory;
    }

    /**
     * Set path to directory which Storage Provider try to load
     * @param string $directory Path to directory
     */
    public function setDirectory(string $directory)
    {
        $this->directory = $directory;
    }

    /**
     * Get classname of Storage provider
     * @return string Classname of Storage Provider
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * Set classname of Storage Provider
     * @param string $provider Classname of Storage Provider
     */
    public function setProvider(string $provider)
    {
        $this->provider = $provider;
    }
}