<?php


namespace EndorphinStudio\Detector\Storage;

use \Ds\Set;

class FileStorage  extends AbstractStorage implements StorageInterface
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
        if($directory === 'default') {
            $directoryIterator = new \DirectoryIterator($this->dataDirectory);
        } else {
            $directoryIterator = new \DirectoryIterator($directory);
        }
        $files = new Set();
        foreach ($directoryIterator as $file) {
            if($file->isDir() && !$file->isDot()) {
                $dirFiles = $this->getFileNames($file->getRealPath());
                $files->add($dirFiles);
            }

            if($file->isFile() && !$file->isLink() && $file->isReadable()) {
                $files->add($file->getRealPath());
            }
        }
        return $files->toArray();
    }
}