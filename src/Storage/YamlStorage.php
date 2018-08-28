<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project browser-detector
 */

namespace EndorphinStudio\Detector\Storage;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlStorage
 * Provide data files reader from yaml files
 * Use symfony\yaml component
 * @package EndorphinStudio\Detector\Storage
 */
class YamlStorage extends FileStorage implements StorageInterface
{
    /**
     * Get array of Data
     * @return array array of data
     */
    public function getConfig(): array
    {
        if (!$this->config || empty($this->config)) {
            $yamlParser = new Parser();
            $files = $this->getFileNames();
            $config = [];
            foreach ($files as $file) {
                $fileConfig = $yamlParser->parseFile($file);
                $config = \array_merge($config, $fileConfig);
            }
            $this->config = $config;
        }
        return $this->config;
    }
}