<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Storage;

use EndorphinStudio\Detector\Tools;

/**
 * File Storage of data
 * Class FileStorage
 * @package EndorphinStudio\Detector\Storage
 */
class FileStorage extends AbstractStorage implements StorageInterface
{
    /**
     * Base method
     * @return array nothing
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * Get list of paths in directory
     * @param string $directory
     * @return array
     */
    protected function getFileNames(string $directory = 'default'): array
    {
        $directoryIterator = $this->getDirectoryIterator($directory);
        $files = [];
        foreach ($directoryIterator as $file) {
            $this->resolveFile($file, $files);
        }
        return $files;
    }

    /**
     * Add file to list or scan directory
     * @param \DirectoryIterator $file
     * @param array $files
     */
    private function resolveFile(\DirectoryIterator $file, array &$files)
    {
        if ($file->isDir() && !$file->isDot()) {
            $files = Tools::resolvePath($files, $this->getFileNames());
        }

        if ($file->isFile() && !$file->isLink() && $file->isReadable()) {
            $files = Tools::resolvePath($files, $file->getRealPath());
        }
    }

    /**
     * Get Directory Iterator
     * @param string $directory
     * @return \DirectoryIterator
     */
    private function getDirectoryIterator(string $directory): \DirectoryIterator
    {
        if ($directory === 'default') {
            return new \DirectoryIterator($this->dataDirectory);
        }
        return new \DirectoryIterator($directory);
    }
}