<?php

namespace EndorphinStudio\Detector\Storage;

use EndorphinStudio\Detector\Tools;

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

    protected function getFileNames(string $directory = 'default'): array
    {
        $directoryIterator = $this->getDirectoryIterator($directory);
        $files = [];
        foreach ($directoryIterator as $file) {
            $this->resolveFile($file, $files);
        }
        return $files;
    }

    private function resolveFile(\DirectoryIterator $file, array &$files)
    {
        if ($file->isDir() && !$file->isDot()) {
            $files = Tools::resolvePath($files, $this->getFileNames());
        }

        if ($file->isFile() && !$file->isLink() && $file->isReadable()) {
            $files = Tools::resolvePath($files, $file->getRealPath());
        }
    }

    private function getDirectoryIterator(string $directory): \DirectoryIterator
    {
        if ($directory === 'default') {
            return new \DirectoryIterator($this->dataDirectory);
        }
        return new \DirectoryIterator($directory);
    }
}