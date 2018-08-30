<?php


namespace EndorphinStudio\Detector\Storage;

use \Ds\Set;

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
        $files = new Set();
        foreach ($directoryIterator as $file) {
            $this->resolveFile($file, $files);
        }
        return $files->toArray();
    }

    private function resolveFile(\DirectoryIterator $file, Set &$files)
    {
        if ($file->isDir() && !$file->isDot()) {
            $files->add($this->getFileNames($file->getRealPath()));
        }

        if ($file->isFile() && !$file->isLink() && $file->isReadable()) {
            $files->add($file->getRealPath());
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