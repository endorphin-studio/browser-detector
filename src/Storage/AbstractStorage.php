<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Storage;

use EndorphinStudio\Detector\Exception\StorageException;

/**
 * Abstract storage of config
 * Class AbstractStorage
 * @package EndorphinStudio\Detector\Storage
 */
abstract class AbstractStorage implements StorageInterface
{
    /**
     * @var array List with config data
     */
    protected $config;

    /**
     * @var string Path to data directory
     */
    protected $dataDirectory;

    /**
     * Set data directory
     * @param string $directory
     * @throws StorageException
     */
    public function setDataDirectory(string $directory)
    {
        if (!is_dir($directory)) {
            $exception = new StorageException(sprintf(StorageException::DIRECTORY_NOT_FOUND, $directory));
            $exception->setDirectory($exception);
            $exception->setProvider(static::class);
            throw $exception;
        }

        $this->dataDirectory = $directory;
    }

    /**
     * Get array of data
     * @return array Data
     */
    public abstract function getConfig(): array;
}